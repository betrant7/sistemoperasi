<?php

namespace App\Controllers;

class ProxmoxConsole extends BaseController
{
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
}
