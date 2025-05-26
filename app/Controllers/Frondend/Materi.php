<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;
use App\Models\laporanPembelajaran;
use App\Models\masterMateri;
use App\Models\masterSubMateri;

class Materi extends BaseController
{
    protected $materi;
    protected $subMateri;
    protected $progres;
    public function __construct()
    {
        $this->materi = new masterMateri();
        $this->subMateri = new masterSubMateri();
        $this->progres = new laporanPembelajaran();
    }
    public function index()
    {
        $data = [
            'materi' => $this->materi->findAll(),
        ];
        return view('frondend/v-materi', $data);
    }

    public function pilihMateri($idMateri)
    {
        $idUser = session()->get('idUser');

        if (!$idUser) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu!');
        }

        $subMateri = $this->subMateri
            ->where('idMateri', $idMateri)
            ->orderBy('idSubMateri', 'ASC')
            ->first();

        $idSubMateri = $subMateri ? $subMateri['idSubMateri'] : null;

        if (!$idSubMateri) {
            return redirect()->back()->with('error', 'Submateri tidak ditemukan.');
        }

        $existing = $this->progres
            ->where('idMateri', $idMateri)
            ->where('idUser', $idUser)
            ->first();

        if (!$existing) {
            $data = [
                'idMateri' => $idMateri,
                'idUser' => $idUser,
                'idSubMateri' => $idSubMateri,
                'progres' => 0,
                'waktuMulai' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ];
            $this->progres->insert($data);
        }

        return redirect()->to('/materi/submateri/' . $idMateri);
    }    
}