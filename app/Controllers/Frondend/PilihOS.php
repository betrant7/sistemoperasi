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

        $data = [
            'vmList' => $vmList,
            'vmData' => $vmData ?? null,
            'vmDetails' => $vmDetails,
            'ticket' => $ticket,
            'wsport' => $wsport
        ];

        echo view('frondend/v-header');
        return view('frondend/v-pilihOS', $data);
    }

    public function createVM($os)
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
            }
        }

        // Jika user sudah memiliki VM dengan OS yang dipilih
        if ($vmData) {
            $auth = proxmox_login(); // Login ke Proxmox
            $postData = []; // Data yang diperlukan untuk start VM
            $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

            if ($result) {
                // Update status VM ke 'aktif'
                $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
            }
            return redirect()->to('/pilihos');
        }

        // Jika belum punya VM, buat VM baru
        $auth = proxmox_login();
        if ($auth) {
            $vmid = rand(100, 999);

            // Pastikan nama valid
            $name = 'vm-'. $os . '-' . $vmid;

            // Set ISO berdasarkan OS yang dipilih
            $iso = '';
            switch($os) {
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

                // Langsung nyalakan VM setelah dibuat
                $vmData = $this->vmModel->getVMByUserId($userId);

                if ($vmData) {
                    $auth = proxmox_login(); // Login ke Proxmox
                    $postData = []; // Data yang diperlukan untuk start VM
                    $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

                    if ($result) {
                        // Update status VM ke 'aktif'
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
}