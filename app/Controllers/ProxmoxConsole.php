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
        
        log_message('debug', 'iframeConsole called for VMID: ' . $vmid . ', User ID: ' . $userId);
        log_message('debug', 'VM Data: ' . json_encode($vmData));
        
        if ($vmData) {
            // Get Proxmox authentication
            $loginData = proxmox_login();
            log_message('debug', 'Proxmox login response: ' . json_encode($loginData));
            
            if ($loginData && isset($loginData['ticket'])) {
                // Retrieve the VNC ticket for direct connection
                $vncResponse = proxmox_post("nodes/server/qemu/$vmid/vncproxy", [], $loginData);
                log_message('debug', 'VNC proxy response: ' . json_encode($vncResponse));
                
                if (isset($vncResponse['data']) && isset($vncResponse['data']['ticket'])) {
                    // Return direct VNC connection parameters
                    $vncData = [
                        'vmid' => $vmid,
                        'jenisVM' => $vmData['jenisVM'],
                        'vncTicket' => $vncResponse['data']['ticket'],
                        'vncPort' => $vncResponse['data']['port'] ?? null,
                        'host' => '203.194.112.201',
                        'proxyUrl' => base_url('noVNC/vnc.html')
                    ];
                    log_message('debug', 'VNC data prepared: ' . json_encode($vncData));
                    
                    // URL for direct VNC access
                    $vncUrl = $vncData['proxyUrl'] . 
                                '?autoconnect=1' .
                                '&host=' . urlencode($vncData['host']) .
                                '&port=6080' .
                                '&password=' . urlencode($vncData['vncTicket']);
                    
                    log_message('debug', 'Redirecting to VNC URL: ' . $vncUrl);
                    return redirect()->to($vncUrl);
                } else {
                    // Fall back to redirecting
                    $jenisVM = $vmData['jenisVM'];
                    $consoleUrl = "https://203.194.112.201:8006/?console=kvm&novnc=1&vmid=$vmid&vmname=vm-$jenisVM-$vmid&node=server&resize=null";
                    log_message('debug', 'VNC ticket not available, falling back to Proxmox console URL: ' . $consoleUrl);
                    return redirect()->to($consoleUrl);
                }
            }
            
            log_message('error', 'Failed to get Proxmox login access for VMID: ' . $vmid);
            return $this->response->setJSON(['error' => 'Gagal mendapatkan akses login']);
        }
        
        log_message('error', 'VM not found for VMID: ' . $vmid);
        return $this->response->setJSON(['error' => 'VM tidak ditemukan']);
    }
}
