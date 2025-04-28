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
        echo view('frondend/v-header');
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

    
    public function subMateri($idMateri)
    {
        $data = [
            'submateri' => $this->subMateri->where('idMateri', $idMateri)->findAll(),
            'materi' => $this->materi->where('idMateri', $idMateri)->first(),
            'idMateri' => $idMateri,
        ];
        echo view('frondend/v-header');
        return view('frondend/v-subMateri', $data);
    }

    public function downProgres()
    {
        $data = $this->request->getJSON();

        // Get total submateri count for this materi
        $totalSubmateri = $this->subMateri->where('idMateri', $data->idMateri)->countAllResults();

        // Calculate progress percentage for each submateri
        $progressPerSubmateri = 100 / $totalSubmateri;

        // Check if record exists for this user and materi
        $existing = $this->progres->where('idUser', $data->idUser)
                        ->where('idMateri', $data->idMateri)
                        ->first();

        if ($existing) {
            // Update existing record with decremented progress
            $newProgress = $existing['progres'] - $progressPerSubmateri;
            if ($newProgress < 0) {
                $newProgress = 0;
            }
            
            $this->progres->update($existing['idlaporanPembelajaran'], [
                'idSubMateri' => $data->idSubMateri,
                'progres' => round($newProgress),
            ]);

            $totalProgress = round($newProgress);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'progress' => $totalProgress
        ]);
    }
    
    public function updateProgres()
    {
        $data = $this->request->getJSON();

        // Get total submateri count for this materi
        $totalSubmateri = $this->subMateri->where('idMateri', $data->idMateri)->countAllResults();

        // Calculate progress percentage for each submateri
        $progressPerSubmateri = 100 / $totalSubmateri;

        // Check if record exists for this user and materi
        $existing = $this->progres->where('idUser', $data->idUser)
                        ->where('idMateri', $data->idMateri)
                        ->first();

        if ($existing) {
            // Update existing record with incremented progress
            $newProgress = $existing['progres'] + $progressPerSubmateri;
            if ($newProgress > 100) {
                $newProgress = 100;
            }
            
            $this->progres->update($existing['idlaporanPembelajaran'], [
                'idSubMateri' => $data->idSubMateri,
                'progres' => round($newProgress),
            ]);

            $totalProgress = round($newProgress);
        } else {
            // Insert first record for this materi
            $this->progres->insert([
                'idUser' => $data->idUser,
                'idMateri' => $data->idMateri,
                'idSubMateri' => $data->idSubMateri,
                'progres' => round($progressPerSubmateri),
                'waktuMulai' => date('Y-m-d H:i:s')
            ]);

            $totalProgress = round($progressPerSubmateri);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'progress' => $totalProgress
        ]);
    }

    public function selesai()
    {
        $data = $this->request->getJSON();

        // Update progress to 100%
        $existing = $this->progres->where('idUser', $data->idUser)
                        ->where('idMateri', $data->idMateri)
                        ->first();

        if ($existing && !$existing['waktuSelesai']) {
            $this->progres->update($existing['idlaporanPembelajaran'], [
                'progres' => 100,
                'waktuSelesai' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ]);
        }
        // Redirect back to materi page
        return redirect()->to('/materi');
    }
    
}