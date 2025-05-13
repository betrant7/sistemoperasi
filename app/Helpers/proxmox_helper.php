<?php

function proxmox_login()
{
    $url = 'https://203.194.112.201:8006/api2/json/access/ticket';
    $data = [
        'username' => 'admin@pam',
        'password' => 'betrant7' // ganti ini ya
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    ]);

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Curl error: ' . curl_error($ch));
    }
    
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
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_TIMEOUT => 30
    ]);

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Curl error in get: ' . curl_error($ch) . ' for endpoint: ' . $endpoint);
    }
    
    curl_close($ch);

    return json_decode($res, true);
}
function proxmox_get($endpoint, $auth)
{
    $url = 'https://203.194.112.201:8006/api2/json/' . $endpoint;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_COOKIE => 'PVEAuthCookie=' . $auth['ticket'],
        CURLOPT_HTTPHEADER => ['CSRFPreventionToken: ' . $auth['CSRFPreventionToken']],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_TIMEOUT => 30
    ]);

    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log('Curl error in get: ' . curl_error($ch) . ' for endpoint: ' . $endpoint);
    }
    
    curl_close($ch);

    return json_decode($res, true);
}

function proxmox_get_console_url($node, $vmid, $auth)
{
    // Endpoint untuk mendapatkan console ticket
    $endpoint = "nodes/{$node}/qemu/{$vmid}/vncproxy";
    
    // Request VNC proxy ticket
    $response = proxmox_post($endpoint, [], $auth);
    
    if (!isset($response['data'])) {
        error_log('Failed to get console ticket: ' . json_encode($response));
        return null;
    }
    
    $consoleData = $response['data'];
    
    // Membuat URL untuk console
    $consoleUrl = "https://203.194.112.201:8006/?console=kvm&novnc=1&node={$node}&vmid={$vmid}&vmname=VM-{$vmid}&ticket=" . urlencode($consoleData['ticket']);
    
    if (isset($consoleData['port'])) {
        $consoleUrl .= "&port=" . $consoleData['port'];
    }
    
    return $consoleUrl;
}

function proxmox_open_console($node, $vmid, $auth)
{
    // Mendapatkan URL console
    $consoleUrl = proxmox_get_console_url($node, $vmid, $auth);
    
    if (!$consoleUrl) {
        return [
            'status' => 'error',
            'message' => 'Gagal mendapatkan akses console VM'
        ];
    }
    
    return [
        'status' => 'success',
        'url' => $consoleUrl
    ];
}