<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;
use App\Models\LaporanPembelajaran;
use App\Models\MasterMateri;
use App\Models\MasterSubMateri;

class Materi extends BaseController
{
    protected $materi;
    protected $subMateri;
    protected $progres;
    public function __construct()
    {
        $this->materi = new MasterMateri();
        $this->subMateri = new MasterSubMateri();
        $this->progres = new LaporanPembelajaran();
    }
    public function index()
    {
        $data = [
            'materi' => $this->materi->findAll(),
        ];
        echo view('frondend/v-header');
        return view('frondend/v-materi', $data);
    }

    public function pilihMateri($idMateri)
    {
        $idUser = session()->get('idUser');

        if (!$idUser) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu!');
        }

        $existing = $this->progres
        ->where('idMateri', $idMateri)
        ->where('idUser', $idUser)
        ->first();

        $data = [
            'idMateri' => $idMateri,
            'idUser' => $idUser,
            'progres' => 0,
            'waktu' => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            $this->progres
                ->where('idMateri', $idMateri)
                ->where('idUser', $idUser)
                ->set($data)
                ->update();
        } else {
            $this->progres->insert($data);
        }

        return redirect()->to('/materi/submateri/' . $idMateri);
    }
    
    public function subMateri($idMateri)
    {
        $data = [
            'submateri' => $this->subMateri->where('idMateri', $idMateri)->findAll(),
            'materi' => $this->materi->where('idMateri', $idMateri)->first(),
        ];
        echo view('frondend/v-header');
        return view('frondend/v-submateri', $data);
    }

    public function progres()
    {
        $request = service('request');
        $data = $request->getJSON();

        if (!$data || !isset($data->idMateri) || !isset($data->idSubMateri)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }

        $idUser = session()->get('idUser');
        $idMateri = $data->idMateri;
        $idSubMateri = $data->idSubMateri;

        if (!$idUser) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak terautentikasi']);
        }

        // Hitung total submateri dalam materi yang sedang dipelajari
        $totalSubMateri = $this->subMateri->where('idMateri', $idMateri)->countAllResults();
        
        if ($totalSubMateri == 0) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Materi tidak memiliki submateri']);
        }

        $progressPerSub = 100 / $totalSubMateri;

        // Cek apakah sudah ada progres sebelumnya
        $existingProgres = $this->progres->where([
            'idUser' => $idUser,
            'idMateri' => $idMateri
        ])->first();

        if ($existingProgres) {
            // Update progres jika sudah ada
            $newProgress = min(100, $existingProgres['progres'] + $progressPerSub);
            $this->progres->update($existingProgres['idlaporanPembelajaran'], [
                'progres' => $newProgress,
                'waktu' => date('Y-m-d H:i:s'),
                'idSubMateri' => $idSubMateri
            ]);
        } else {
            // Buat progres baru jika belum ada
            $newProgress = $progressPerSub;
            $this->progres->insert([
                'idUser' => $idUser,
                'idMateri' => $idMateri,
                'idSubMateri' => $idSubMateri,
                'progres' => $newProgress,
                'waktu' => date('Y-m-d H:i:s')
            ]);
        }

        return $this->response->setJSON(['status' => 'success', 'progress' => $newProgress]);
    }


}