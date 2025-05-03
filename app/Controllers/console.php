<?php

namespace App\Controllers;

class console extends BaseController
{
    public function getData() {
        $apiUrl = 'https://203.194.112.201:8006/api2/json/nodes/server/qemu/379/vncproxy';

        $client = \Config\Services::curlrequest();

        $response = $client->post($apiUrl, [
                'verify' => false, // abaikan SSL (jika self-signed)
                'headers' => [
                        'Authorization' => 'PVEAPIToken=admin@pam!betrant7=b64750b5-a14d-4dd4-a1b1-4ded3f727cef',
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                        'websocket' => 1
                ]
        ]);

        $data = json_decode($response->getBody(), true);
        return view('v-console', $data);
    }
}
