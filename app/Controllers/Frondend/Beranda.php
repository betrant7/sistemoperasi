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
        return view('frondend/v-beranda', $data);
    }
    public function logout()
    {
        $session = session();
        $userId = $session->get('idUser');
        if ($userId) {
            $this->masterUser->update($userId, ['status' => 'tidak aktif']);
        }
        $session->destroy(); // Hapus semua session
        return redirect()->to('/')->with('success', 'Anda telah logout.');
    }
}