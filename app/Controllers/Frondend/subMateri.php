<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;
use App\Models\laporanPembelajaran;
use App\Models\masterMateri;
use App\Models\masterSubMateri;
use App\Models\masterVM;

class SubMateri extends BaseController
{
    protected $materi;
    protected $subMateri;
    protected $progres;
    protected $vmModel;
    public function __construct()
    {
        $this->materi = new masterMateri();
        $this->subMateri = new masterSubMateri();
        $this->progres = new laporanPembelajaran();
        $this->vmModel = new masterVM();
    }

    public function subMateri($idMateri)
    {
        $auth = proxmox_login();
        $vmList = [];
        $vmDetails = [];
        $ticket = null;

        if ($auth) {
            $vmListResponse = proxmox_get('nodes/server/qemu', $auth);
            if (isset($vmListResponse['data'])) {
                $vmList = $vmListResponse['data'];
            }

            // Get user's VM data
            $userId = session()->get('idUser');
            $vmData = $this->vmModel->getActiveVMsByUserId($userId);

            if ($vmData) {
                // Get detailed VM information from Proxmox
                $vmDetailsResponse = proxmox_get('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/current', $auth);
                if (isset($vmDetailsResponse['data'])) {
                    $vmDetails = $vmDetailsResponse['data'];
                }

                // Get VNC ticket for console access
                $ticketResponse = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/vncproxy', [], $auth);
                if (isset($ticketResponse['data'])) {
                    $ticket = $ticketResponse['data']['ticket'];
                    if (isset($ticketResponse['data']['port'])) {
                        $wsport = $ticketResponse['data']['port'];
                    }
                }
            }
        }
        // Integrasi logika VM dan noVNC dari PilihOS
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->getActiveVMsByUserId($userId);
        $novnc_url = null;
        if (!empty($vmData) && $vmData['status'] == 'aktif') {
            $node = $vmData['node'] ?? 'server';
            $auth = proxmox_login();
            if ($auth && isset($auth['ticket'])) {
                $vnc = proxmox_post("nodes/$node/qemu/{$vmData['idVmProxmox']}/vncproxy", [], $auth);
                if (isset($vnc['data']['ticket']) && isset($vnc['data']['port'])) {
                    $ticket = $vnc['data']['ticket'];
                    $vnc_port = $vnc['data']['port'];
                    $ws_port = $this->findAvailablePort(6100, 6200);
                    $cmd = "nohup websockify --web /var/www/html/sistemoperasi/public/noVNC --cert=/etc/letsencrypt/live/ujicobavps.cloud/fullchain.pem --key=/etc/letsencrypt/live/ujicobavps.cloud/privkey.pem $ws_port 203.194.112.201:$vnc_port > /tmp/websockify_$ws_port.log 2>&1 &";
                    exec($cmd);
                    $novnc_url = base_url("noVNC/vnc.html?host=ujicobavps.cloud&port=$ws_port&autoconnect=1&password=$ticket");
                }
            }
        }
        $data = [
            'submateri' => $this->subMateri->where('idMateri', $idMateri)->findAll(),
            'materi' => $this->materi->where('idMateri', $idMateri)->first(),
            'idMateri' => $idMateri,
            'vmData' => $vmData,
            'novnc_url' => $novnc_url,
            'vmList' => $vmList,
            'vmDetails' => $vmDetails,
            'ticket' => $ticket,
        ];

        echo view('frondend/v-header');
        return view('frondend/v-subMateri', $data);
    }

    public function cekVM($os, $idMateri)
    {
        $userId = session()->get('idUser'); // Ambil ID user dari session
        $vmData = $this->vmModel->getVMByUserIdAndJenisVM($userId, $os);

        // Cek apakah ada VM aktif lain milik user
        $activeVM = $this->vmModel->getActiveVMsByUserId($userId);
        if ($activeVM && $activeVM['jenisVM'] != $os) {
            // Matikan VM yang sedang aktif
            $auth = proxmox_login();
            $postData = [];
            $result = proxmox_post('nodes/server/qemu/' . $activeVM['idVmProxmox'] . '/status/stop', $postData, $auth);
            if ($result) {
                $this->vmModel->updateVMStatus($activeVM['idVM'], 'nonaktif');
                // Tambahkan delay untuk memastikan VM benar-benar berhenti
                sleep(2);
            }
        }

        // Jika user sudah memiliki VM dengan OS yang dipilih
        if ($vmData) {
            $auth = proxmox_login(); // Login ke Proxmox
            
            // Cek status VM di Proxmox sebelum mencoba start
            $vmStatusResponse = proxmox_get('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/current', $auth);
            $vmStatus = isset($vmStatusResponse['data']['status']) ? $vmStatusResponse['data']['status'] : '';
            
            // Hanya start VM jika statusnya bukan 'running'
            if ($vmStatus != 'running') {
                $postData = []; // Data yang diperlukan untuk start VM
                $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

                if ($result) {
                    // Update status VM ke 'aktif'
                    $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
                    // Tambahkan delay untuk memastikan VM benar-benar start
                    sleep(2);
                }
            } else {
                // VM sudah running, pastikan status di database juga 'aktif'
                $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
            }
            
            return redirect()->to('materi/submateri/' . $idMateri);
        }

        // Jika belum punya VM, buat VM baru
        $auth = proxmox_login();
        if ($auth) {
            $vmid = rand(100, 999);

            // Pastikan nama valid
            $name = 'vm-' . $os . '-' . $vmid;

            // Set ISO berdasarkan OS yang dipilih
            $iso = '';
            switch ($os) {
                case 'centos':
                    $iso = 'local:iso/CentOS-7-x86_64-DVD-2009.iso,media=cdrom';
                    break;
                case 'debian':
                    $iso = 'local:iso/debian-11.6.0-amd64-netinst.iso,media=cdrom';
                    break;
                case 'ubuntu':
                    $iso = 'local:iso/ubuntu-20.04.3-live-server-amd64.iso,media=cdrom';
                    break;
                case 'kalilinux':
                    $iso = 'local:iso/kali-linux-2022.4-installer-netinst-amd64.iso,media=cdrom';
                    break;
                default:
                    echo "OS tidak valid";
                    return;
            }

            $postData = [
                'vmid' => $vmid,
                'name' => $name,
                'node' => 'server',
                'memory' => 2048,
                'cores' => 1,
                'ide2' => $iso,
                'net0' => 'virtio,bridge=vmbr0,firewall=1',
                'scsi0' => 'local:32,format=qcow2,iothread=on',
                'scsihw' => 'virtio-scsi-single',
            ];

            $createVM = proxmox_post('nodes/server/qemu', $postData, $auth);

            if ($createVM && isset($createVM['data'])) {
                $this->vmModel->createVM([
                    'idUser' => $userId,
                    'idVmProxmox' => $vmid,
                    'status' => 'aktif',
                    'node' => 'server',
                    'jenisVM' => $os,
                ]);

                // Tambahkan delay untuk memastikan VM benar-benar dibuat
                sleep(3);

                // Langsung nyalakan VM setelah dibuat
                $vmData = $this->vmModel->getVMByUserId($userId);

                if ($vmData) {
                    $auth = proxmox_login(); // Login ke Proxmox
                    $postData = []; // Data yang diperlukan untuk start VM
                    $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

                    if ($result) {
                        // Update status VM ke 'aktif'
                        $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
                        // Tambahkan delay untuk memastikan VM benar-benar start
                        sleep(2);
                    }
                    return redirect()->to('materi/submateri/' . $idMateri);
                }

            } else {
                echo "Gagal membuat VM. Error: " . json_encode($createVM);
            }
        }
        return redirect()->to('materi/submateri/' . $idMateri);
    }

    public function downProgres()
    {
        $data = $this->request->getJSON();

        // Get total submateri count for this materi
        $totalSubmateri = $this->subMateri->where('idMateri', $data->idMateri)->countAllResults();

        // Calculate progress percentage for each submateri
        $progressPerSubmateri = 100 / $totalSubmateri;

        // Check if record exists for this user and materi
        $existing = $this->progres->where('idUser', $data->idUser)
            ->where('idMateri', $data->idMateri)
            ->first();

        if ($existing) {
            // Update existing record with decremented progress
            $newProgress = $existing['progres'] - $progressPerSubmateri;
            if ($newProgress < 0) {
                $newProgress = 0;
            }

            $this->progres->update($existing['idlaporanPembelajaran'], [
                'idSubMateri' => $data->idSubMateri,
                'progres' => round($newProgress),
            ]);

            $totalProgress = round($newProgress);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'progress' => $totalProgress
        ]);
    }

    public function updateProgres()
    {
        $data = $this->request->getJSON();

        // Get total submateri count for this materi
        $totalSubmateri = $this->subMateri->where('idMateri', $data->idMateri)->countAllResults();

        // Calculate progress percentage for each submateri
        $progressPerSubmateri = 100 / $totalSubmateri;

        // Check if record exists for this user and materi
        $existing = $this->progres->where('idUser', $data->idUser)
            ->where('idMateri', $data->idMateri)
            ->first();

        if ($existing) {
            // Update existing record with incremented progress
            $newProgress = $existing['progres'] + $progressPerSubmateri;
            if ($newProgress > 100) {
                $newProgress = 100;
            }

            $this->progres->update($existing['idlaporanPembelajaran'], [
                'idSubMateri' => $data->idSubMateri,
                'progres' => round($newProgress),
            ]);

            $totalProgress = round($newProgress);
        } else {
            // Insert first record for this materi
            $this->progres->insert([
                'idUser' => $data->idUser,
                'idMateri' => $data->idMateri,
                'idSubMateri' => $data->idSubMateri,
                'progres' => round($progressPerSubmateri),
                'waktuMulai' => date('Y-m-d H:i:s')
            ]);

            $totalProgress = round($progressPerSubmateri);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'progress' => $totalProgress
        ]);
    }

    public function selesai()
    {
        $data = $this->request->getJSON();

        // Update progress to 100%
        $existing = $this->progres->where('idUser', $data->idUser)
            ->where('idMateri', $data->idMateri)
            ->first();

        if ($existing && !$existing['waktuSelesai']) {
            $this->progres->update($existing['idlaporanPembelajaran'], [
                'progres' => 100,
                'waktuSelesai' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ]);
        }
        // Redirect back to materi page
        return redirect()->to('/materi');
    }

    private function findAvailablePort($start, $end)
    {
        for ($port = $start; $port <= $end; $port++) {
            $connection = @fsockopen('localhost', $port);
            if (is_resource($connection)) {
                fclose($connection);
            } else {
                return $port;
            }
        }
        throw new \Exception("No available port found in range $start-$end");
    }
}