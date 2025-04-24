<?php

namespace App\Controllers;

use App\Models\laporanPembelajaran;
use App\Models\masterMateri;
use App\Models\masterUser;
use CodeIgniter\Controller;

class LaporanProgres extends Controller
{
    protected $progres;
    protected $user;
    protected $materi;

    public function __construct()
    {
        $this->progres = new laporanPembelajaran();
        $this->materi = new masterMateri();
        $this->user = new masterUser();
    }

    // public function index()
    // {
    //     $idUser = session()->get('idUser');
    //     $data = [
    //         'materiList' => $this->materi->findAll(),
    //         'progres' => $this->progres->findAll($idUser)
    //     ];
    //     echo view('v-header');
    //     return view('v-laporanProgres', $data);
    // }

    public function index()
    {
        // Ambil semua user
        $users = $this->user->where('role', 'mahasiswa')->findAll();
        $materiList = $this->materi->findAll();

        $progres = [];

        foreach ($users as $user) {
            // Ambil materi yang sedang dikerjakan user ini (bisa berdasarkan idMateri terakhir, atau default)
            $latestProgress = $this->progres
                ->where('idUser', $user['idUser'])
                ->orderBy('idlaporanPembelajaran', 'DESC')
                ->first();

            $idMateri = $latestProgress['idMateri'] ?? null;
            $progress = $latestProgress['progres'] ?? 0;

            $progres[] = [
                'idUser' => $user['idUser'],
                'namaLengkap' => $user['namaLengkap'],
                'kelas' => $user['kelas'],
                'idMateri' => $idMateri,
                'progres' => $progress,
            ];
        }
        echo view('v-header');

        return view('v-laporanProgres', [
            'progres' => $progres,
            'materiList' => $materiList
        ]);
    }

    public function getProgres()
    {
        $data = $this->request->getJSON();
    
        $row = $this->progres
                    ->where('idUser', $data->idUser)
                    ->where('idMateri', $data->idMateri)
                    ->first();
    
        $progress = $row ? $row['progres'] : 0;
    
        return $this->response->setJSON(['progres' => $progress]);
    }
}
