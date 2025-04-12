<?php

function proxmox_login()
{
    $url = 'https://203.194.112.201:8006/api2/json/access/ticket';
    $data = [
        'username' => 'root@pam',
        'password' => 'betrant7' // ganti ini ya
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $res = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($res, true);
    return $json['data'] ?? null;
}

function proxmox_post($endpoint, $postData, $auth)
{
    $url = 'https://203.194.112.201:8006/api2/json/' . $endpoint;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_COOKIE => 'PVEAuthCookie=' . $auth['ticket'],
        CURLOPT_HTTPHEADER => ['CSRFPreventionToken: ' . $auth['CSRFPreventionToken']],
        CURLOPT_SSL_VERIFYPEER => false
    ]);

    $res = curl_exec($ch);
    curl_close($ch);

    return json_decode($res, true);
}