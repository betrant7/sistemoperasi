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

        if ($vmData) {
            $node = $vmData['node'] ?? 'server';
            $auth = proxmox_login();

            if ($auth && isset($auth['ticket'])) {
                $vnc = proxmox_post("nodes/$node/qemu/$vmid/vncproxy", [], $auth);
                if (isset($vnc['data']['ticket']) && isset($vnc['data']['port'])) {
                    $ticket = $vnc['data']['ticket'];
                    $vnc_port = $vnc['data']['port'];

                    // Cari port websockify yang belum dipakai (misal: 6100-6200)
                    $ws_port = $this->findAvailablePort(6100, 6200);

                    // Jalankan websockify secara background (pastikan path dan user benar)
                    $cmd = "nohup websockify --web /var/www/html/sistemoperasi/public/noVNC --cert=/etc/letsencrypt/live/ujicobavps.cloud/fullchain.pem --key=/etc/letsencrypt/live/ujicobavps.cloud/privkey.pem $ws_port 203.194.112.201:$vnc_port > /tmp/websockify_$ws_port.log 2>&1 &";
                    exec($cmd);

                    // Kirim ke view
                    $novnc_url = base_url("noVNC/vnc.html?host=ujicobavps.cloud&port=$ws_port&autoconnect=1&password=$ticket");
                    return view('frondend/v-novnc', [
                        'novnc_url' => $novnc_url
                    ]);
                } else {
                    return "Gagal mendapatkan ticket/port VNC";
                }
            } else {
                return "Gagal login ke Proxmox";
            }
        }
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
