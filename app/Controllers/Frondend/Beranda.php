<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;
use App\Models\masterUser;

class Beranda extends BaseController
{
    protected $masterUser;
    public function __construct()
    {
        $this->masterUser = new masterUser();
    }
    public function index()
    {
        $data = [
            'user' => $this->masterUser->getUser(),
        ];
        echo view('frondend/v-header');
        return view('frondend/v-beranda', $data);
    }
    public function logout()
    {
        $session = session();
        $session->destroy(); // Hapus semua session
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}