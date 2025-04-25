<?php

namespace App\Controllers;
use App\Models\masterVM;

class Console extends BaseController
{
    protected $vmModel;

    public function __construct()
    {
        $this->vmModel = new masterVM();
    }

    // Menampilkan halaman VM mahasiswa
    public function index()
    {
        $userId = session()->get('idUser'); // Ambil ID user dari session
        $vmData = $this->vmModel->getVMByUserId($userId);

        if (!$vmData) {
            // Jika mahasiswa belum memiliki VM, buatkan VM baru
            $this->createVM($userId);
            $vmData = $this->vmModel->getVMByUserId($userId);
        }

        return view('vm_console', ['vmData' => $vmData]);
    }

    // Fungsi untuk membuat VM baru
    private function createVM($userId)
    {
        // Panggil API untuk create VM baru (misalnya cloning VM)
        $auth = proxmox_login(); // Fungsi login Proxmox
        if ($auth) {
            $postData = [
                'vmid' => rand(100, 999), // VM ID random atau bisa sesuai template
                'node' => 'server',
                // Informasi lainnya yang diperlukan untuk create VM
            ];

            // Menggunakan API Proxmox untuk membuat VM baru (misalnya cloning)
            $createVM = proxmox_post('nodes/server/qemu', $postData, $auth);

            if ($createVM && isset($createVM['data'])) {
                // Simpan VM baru ke database
                $this->vmModel->createVM([
                    'idUser' => $userId,
                    'idVmProxmox' => $createVM['data']['vmid'], // Menyimpan VM ID dari Proxmox
                    'status' => 'aktif',
                    'node' => 'server',
                ]);
            }
        }
    }

    // Fungsi untuk menyalakan VM
    public function startVM()
    {
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->getVMByUserId($userId);

        if ($vmData) {
            $auth = proxmox_login(); // Login ke Proxmox
            $postData = []; // Data yang diperlukan untuk start VM
            $result = proxmox_post('nodes/server/qemu/' . $vmData['idVmProxmox'] . '/status/start', $postData, $auth);

            if ($result) {
                // Update status VM ke 'aktif'
                $this->vmModel->updateVMStatus($vmData['idVM'], 'aktif');
            }
        }

        return redirect()->to('/vm_console');
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

        return redirect()->to('/vm_console');
    }
}