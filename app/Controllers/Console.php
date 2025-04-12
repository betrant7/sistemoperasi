<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Console extends Controller
{
    public function index($vmid)
    {
        helper('proxmox');

        $node = 'server'; // ganti sesuai nama node kamu
        $host = '203.194.112.201';

        $login = proxmox_login();

        if (!$login || !isset($login['ticket'])) {
            return 'Gagal login ke Proxmox';
        }

        $vnc = proxmox_post("nodes/{$node}/qemu/{$vmid}/vncproxy", [
            'websocket' => 1
        ], $login);

        if (!isset($vnc['data']['port'], $vnc['data']['ticket'])) {
            return 'Gagal mendapatkan data VNC';
        }

        return view('vm_console', [
            'host' => $host,
            'port' => $vnc['data']['port'],
            'vncticket' => $vnc['data']['ticket'],
            'path' => "api2/json/nodes/{$node}/qemu/{$vmid}/vncwebsocket"
        ]);
    }
}


    // public function index($vmid)
    // {
    //     $node = 'server'; // Ganti sesuai nama node
    //     $proxmoxIP = '203.194.112.201';
    //     $username = 'betrant@pve';
    //     $password = 'betrant7'; // GANTI

    //     // 1. Login ke Proxmox API
    //     $client = \Config\Services::curlrequest();
    //     $response = $client->post("https://$proxmoxIP:8006/api2/json/access/ticket", [
    //         'verify' => false,
    //         'form_params' => [
    //             'username' => $username,
    //             'password' => $password
    //         ]
    //     ]);

    //     $body = json_decode($response->getBody(), true);
    //     $ticket = $body['data']['ticket'];
    //     $csrf = $body['data']['CSRFPreventionToken'];

    //     // 2. Dapatkan VNC Proxy Info
    //     $response2 = $client->post("https://$proxmoxIP:8006/api2/json/nodes/$node/qemu/$vmid/vncproxy", [
    //         'verify' => false,
    //         'headers' => [
    //             'Cookie' => "PVEAuthCookie=$ticket",
    //             'CSRFPreventionToken' => $csrf,
    //         ],
    //         'form_params' => [
    //             'websocket' => 1
    //         ]
    //     ]);

    //     $vnc = json_decode($response2->getBody(), true)['data'];

    //     // Kirim data ke view
    //     return view('vm_console', [
    //         'websocket_port' => $vnc['port'],
    //         'vnc_ticket' => $vnc['ticket'],
    //         'proxmox_ip' => $proxmoxIP
    //     ]);
    // }
