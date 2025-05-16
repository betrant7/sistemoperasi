<?php

namespace App\Controllers;

use App\Models\MasterVM;

class ProxmoxConsole extends BaseController
{
    protected $vmModel;

    public function __construct()
    {
        $this->vmModel = new MasterVM();
    }
    public function login()
    {
        $loginData = proxmox_login();

        if ($loginData) {
            return $this->response->setJSON([
                'status' => 'success',
                'ticket' => $loginData['ticket'],
                'CSRFPreventionToken' => $loginData['CSRFPreventionToken'],
                'username' => $loginData['username']
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal login ke Proxmox API'
            ]);
        }
    }

    public function redirectConsole($vmid)
    {
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->where('idVmProxmox', $vmid)->first();

        if ($vmData) {
            $jenisVM = $vmData['jenisVM'];
            $consoleUrl = "https://203.194.112.201:8006/?console=kvm&novnc=1&vmid=$vmid&vmname=vm-$jenisVM-$vmid&node=server&resize=null";
            return redirect()->to($consoleUrl);
        }

        return redirect()->to('/pilihos')->with('error', 'VM tidak ditemukan');
    }
    public function iframeConsole($vmid)
    {
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->where('idVmProxmox', $vmid)->first();

        if ($vmData) {
            // Ambil node dari database, atau hardcode jika hanya satu node
            $node = $vmData['node'] ?? 'server'; // pastikan field 'node' ada di tabel
            $auth = proxmox_login();

            if ($auth && isset($auth['ticket'])) {
                $result = proxmox_open_console($node, $vmid, $auth);

                if ($result['status'] == 'success') {
                    // Redirect ke URL console Proxmox
                    return redirect()->to($result['url']);
                } else {
                    return $this->response->setBody('Gagal mendapatkan akses console VM');
                }
            } else {
                return $this->response->setBody('Gagal login ke Proxmox');
            }
        }
        return $this->response->setBody('VM tidak ditemukan');
    }

    public function novnc($vmid)
    {
        $userId = session()->get('idUser');
        $vmData = $this->vmModel->where('idVmProxmox', $vmid)->first();

        $debugLog = WRITEPATH . 'novnc_debug.log';
        file_put_contents($debugLog, "==== NOVNC DEBUG ====\n", FILE_APPEND);
        file_put_contents($debugLog, "UserID: $userId, VMID: $vmid\n", FILE_APPEND);

        if ($vmData) {
            $node = $vmData['node'] ?? 'server';
            file_put_contents($debugLog, "Node: $node\n", FILE_APPEND);

            $auth = proxmox_login();
            file_put_contents($debugLog, "Auth: " . json_encode($auth) . "\n", FILE_APPEND);

            if ($auth && isset($auth['ticket'])) {
                $vnc = proxmox_post("nodes/$node/qemu/$vmid/vncproxy", [], $auth);
                file_put_contents($debugLog, "VNC Response: " . json_encode($vnc) . "\n", FILE_APPEND);

                if (isset($vnc['data']['ticket']) && isset($vnc['data']['port'])) {
                    $ticket = $vnc['data']['ticket'];
                    $vnc_port = $vnc['data']['port'];

                    // Generate token unik (misal: userID_timestamp)
                    $token = 'user' . $userId . '_' . time();
                    file_put_contents($debugLog, "Token: $token, VNC Port: $vnc_port\n", FILE_APPEND);

                    // Use CodeIgniter's writable directory
                    $tokenFile = WRITEPATH . 'tokens';

                    // Ensure the file exists
                    if (!file_exists($tokenFile)) {
                        file_put_contents($tokenFile, "# Proxmox VNC Tokens\n");
                    }

                    // Write token mapping
                    $tokenLine = "$token: 203.194.112.201:$vnc_port\n";
                    file_put_contents($debugLog, "Writing to token file: $tokenLine", FILE_APPEND);
                    file_put_contents($tokenFile, $tokenLine, FILE_APPEND);

                    // Log isi file token
                    $tokensContent = file_get_contents($tokenFile);
                    file_put_contents($debugLog, "Current tokens file:\n$tokensContent\n", FILE_APPEND);

                    // Buat URL noVNC dengan path token
                    $novnc_url = base_url("noVNC/vnc.html?host=ujicobavps.cloud&port=6100&path=/$token&autoconnect=1&password=$ticket");
                    file_put_contents($debugLog, "noVNC URL: $novnc_url\n", FILE_APPEND);

                    // (Opsional) Tampilkan debug ke browser juga
                    // return "<pre>" . htmlspecialchars(file_get_contents($debugLog)) . "</pre>";

                    return view('frondend/v-novnc', [
                        'novnc_url' => $novnc_url
                    ]);
                } else {
                    file_put_contents($debugLog, "Gagal mendapatkan ticket/port VNC\n", FILE_APPEND);
                    return "Gagal mendapatkan ticket/port VNC";
                }
            } else {
                file_put_contents($debugLog, "Gagal login ke Proxmox\n", FILE_APPEND);
                return "Gagal login ke Proxmox";
            }
        }
        file_put_contents($debugLog, "VM tidak ditemukan\n", FILE_APPEND);
        return "VM tidak ditemukan";
    }

    // Fungsi untuk mencari port kosong
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
