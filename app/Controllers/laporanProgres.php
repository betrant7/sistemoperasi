<?php

namespace App\Controllers;

use App\Models\LaporanPembelajaran;
use App\Models\masterMateri;
use CodeIgniter\Controller;

class LaporanProgres extends Controller
{
    protected $progres;
    protected $materi;

    public function __construct()
    {
        $this->progres = new laporanPembelajaran();
        $this->materi = new masterMateri();
    }

    public function index()
    {
        $idUser = session()->get('idUser');
        $data = [
            'materiList' => $this->materi->findAll(),
            'progres' => $this->progres->getProgresByUser($idUser)
        ];
        echo view('v-header');
        return view('v-laporanProgres', $data);
    }

    public function updateProgress()
    {
        // Debugging: Tampilkan data yang diterima
        return $this->response->setJSON([
            'idUser' => session()->get('idUser'),
            'idMateri' => $this->request->getPost('idMateri'),
            'idSubMateri' => $this->request->getPost('idSubMateri'),
            'totalSubMateri' => $this->request->getPost('totalSubMateri')
        ]);
    }
}
