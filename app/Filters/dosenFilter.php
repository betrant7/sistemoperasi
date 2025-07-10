<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Session\Session;

class DosenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->has('role')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        if ($session->get('role') !== 'dosen') {
            if (!in_array(uri_string(), ['beranda', 'beranda/index'])) { 
                return redirect()->to('/beranda')->with('error', 'Anda tidak memiliki izin.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa pun setelah request
    }
}
