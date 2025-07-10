<?php

namespace App\Controllers;

use App\Models\masterUser;

class DataMahasiswa extends BaseController
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
        return view('v-dataMahasiswa', $data);
    }

    public function deleteUser($idUser)
    {
        $this->masterUser->delete($idUser);
        session()->setFlashdata('success', 'Data Mahasiswa berhasil dihapus');
        return redirect()->to(base_url('datamahasiswa'));
    }
}