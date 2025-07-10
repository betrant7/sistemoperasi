<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;
use App\Models\masterVM;

class PilihOS extends BaseController
{
    protected $vmModel;

    public function __construct()
    {
        $this->vmModel = new masterVM();
    }

    public function index()
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

<<<<<<< HEAD
=======
            // Get user's VM data
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
            $userId = session()->get('idUser');
            $vmData = $this->vmModel->getActiveVMsByUserId($userId);

            if ($vmData) {
<<<<<<< HEAD
=======
                // Get detailed VM information from Proxmox
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
                $vmDetailsResponse = proxmox_get('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/current', $auth);
                if (isset($vmDetailsResponse['data'])) {
                    $vmDetails = $vmDetailsResponse['data'];
                }

<<<<<<< HEAD
=======
                // Get VNC ticket for console access
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
                $ticketResponse = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/vncproxy', [], $auth);
                if (isset($ticketResponse['data'])) {
                    $ticket = $ticketResponse['data']['ticket'];
                    if (isset($ticketResponse['data']['port'])) {
                        $wsport = $ticketResponse['data']['port'];
                    }
                }
            }
        }

<<<<<<< HEAD
=======
        // Tambahkan logika noVNC jika VM aktif
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
        $novnc_url = null;
        if (!empty($vmData) && $vmData['status'] == 'aktif') {
            $node = $vmData['node'] ?? 'server';
            $auth = proxmox_login();
            if ($auth && isset($auth['ticket'])) {
                $vnc = proxmox_post("nodes/$node/qemu/{$vmData['idVmProxmox']}/vncproxy", [], $auth);
                if (isset($vnc['data']['ticket']) && isset($vnc['data']['port'])) {
                    $ticket = $vnc['data']['ticket'];
                    $vnc_port = $vnc['data']['port'];
<<<<<<< HEAD
                    $ws_port = $this->findAvailablePort(6100, 6200);
=======
                    // Cari port websockify yang belum dipakai (misal: 6100-6200)
                    $ws_port = $this->findAvailablePort(6100, 6200);
                    // Jalankan websockify secara background (pastikan path dan user benar)
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
                    $cmd = "nohup websockify --web /var/www/html/sistemoperasi/public/noVNC --cert=/etc/letsencrypt/live/ujicobavps.cloud/fullchain.pem --key=/etc/letsencrypt/live/ujicobavps.cloud/privkey.pem $ws_port 203.194.112.201:$vnc_port > /tmp/websockify_$ws_port.log 2>&1 &";
                    exec($cmd);
                    $novnc_url = base_url("noVNC/vnc.html?host=ujicobavps.cloud&port=$ws_port&autoconnect=1&password=$ticket");
                }
            }
        }
        $data = [
            'vmList' => $vmList,
            'vmData' => $vmData ?? null,
            'vmDetails' => $vmDetails,
            'ticket' => $ticket,
            'novnc_url' => $novnc_url,
        ];

        return view('frondend/v-pilihOS', $data);
    }

    public function createVM($os)
    {
<<<<<<< HEAD
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->getVMByUserIdAndJenisVM($userId, $os);

        $activeVM = $this->vmModel->getActiveVMsByUserId($userId);
        if ($activeVM && $activeVM['jenisVM'] != $os) {
=======
        $userId = session()->get('idUser'); // Ambil ID user dari session
        $vmData = $this->vmModel->getVMByUserIdAndJenisVM($userId, $os);

        // Cek apakah ada VM aktif lain milik user
        $activeVM = $this->vmModel->getActiveVMsByUserId($userId);
        if ($activeVM && $activeVM['jenisVM'] != $os) {
            // Matikan VM yang sedang aktif
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
            $auth = proxmox_login();
            $postData = [];
            $result = proxmox_post('nodes/server/qemu/' . $activeVM['idVmProxmox'] . '/status/stop', $postData, $auth);
            if ($result) {
                $this->vmModel->updateVMStatus($activeVM['idVM'], 'nonaktif');
            }
        }

<<<<<<< HEAD
        if ($vmData) {
            $auth = proxmox_login(); 
            $postData = [];
            $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

            if ($result) {
=======
        // Jika user sudah memiliki VM dengan OS yang dipilih
        if ($vmData) {
            $auth = proxmox_login(); // Login ke Proxmox
            $postData = []; // Data yang diperlukan untuk start VM
            $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

            if ($result) {
                // Update status VM ke 'aktif'
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
                $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
            }
            return redirect()->to('/pilihos');
        }

<<<<<<< HEAD
=======
        // Jika belum punya VM, buat VM baru
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
        $auth = proxmox_login();
        if ($auth) {
            $vmid = rand(100, 999);

<<<<<<< HEAD
            $name = 'vm-' . $os . '-' . $vmid;

=======
            // Pastikan nama valid
            $name = 'vm-' . $os . '-' . $vmid;

            // Set ISO berdasarkan OS yang dipilih
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
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

<<<<<<< HEAD
                $vmData = $this->vmModel->getVMByUserId($userId);

                if ($vmData) {
                    $auth = proxmox_login();
                    $postData = [];
                    $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

                    if ($result) {
=======
                // Langsung nyalakan VM setelah dibuat
                $vmData = $this->vmModel->getVMByUserId($userId);

                if ($vmData) {
                    $auth = proxmox_login(); // Login ke Proxmox
                    $postData = []; // Data yang diperlukan untuk start VM
                    $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

                    if ($result) {
                        // Update status VM ke 'aktif'
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
                        $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
                    }
                    return redirect()->to('/pilihos');
                }

            } else {
                echo "Gagal membuat VM. Error: " . json_encode($createVM);
            }
        }
        return redirect()->to('/pilihos');
    }

<<<<<<< HEAD
    // public function stopVM()
    // {
    //     $userId = session()->get('idUser');
    //     $vmData = $this->vmModel->getVMByUserId($userId);

    //     if ($vmData) {
    //         $auth = proxmox_login(); // Login ke Proxmox
    //         $postData = []; // Data yang diperlukan untuk stop VM
    //         $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/stop', $postData, $auth);

    //         if ($result) {
    //             // Update status VM ke 'nonaktif'
    //             $this->vmModel->updateVMStatus($vmData['idVM'], 'nonaktif');
    //         }
    //     }

    //     return redirect()->to('/pilihos');
    // }


=======
    // Fungsi untuk mematikan VM
    public function stopVM()
    {
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->getVMByUserId($userId);

        if ($vmData) {
            $auth = proxmox_login(); // Login ke Proxmox
            $postData = []; // Data yang diperlukan untuk stop VM
            $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/stop', $postData, $auth);

            if ($result) {
                // Update status VM ke 'nonaktif'
                $this->vmModel->updateVMStatus($vmData['idVM'], 'nonaktif');
            }
        }

        return redirect()->to('/pilihos');
    }

    // Fungsi untuk mencari port kosong
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
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