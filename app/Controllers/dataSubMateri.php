<?php

namespace App\Controllers;

use App\Models\masterMateri;
use App\Models\masterSubMateri;

class DataSubMateri extends BaseController
{
    protected $materi;
    protected $subMateri;

    public function __construct()
    {
        $this->subMateri = new masterSubMateri();
        $this->materi = new masterMateri();
    }

    public function index($idMateri)
    {
        $data = [
            'submateri' => $this->subMateri->where('idMateri', $idMateri)->findAll(),
            'materi' => $this->materi->where('idMateri', $idMateri)->first(),
        ];

        echo view('v-header');
        return view('subMateri/v-dataSubMateri', $data);
    }
    public function tambahSub($idMateri)
    {
        $data = ['idMateri' => $idMateri];
        echo view('v-header');
        return view('subMateri/v-tambahSubMateri', $data);
    }

    public function tambahSubProses()
    {
        $idMateri = $this->request->getPost('idMateri');

        $this->subMateri->insert([
            'idMateri' => $idMateri,
            'judulMateri' => $this->request->getPost('judulMateri'),
            'dataMateri' => $this->request->getPost('dataMateri'),
        ]);

        return redirect()->to('datasubmateri/' . $idMateri)->with('success', 'Materi berhasil ditambahkan.');
    }

    public function updateSub($idSubMateri)
    {
        $data = [
            'subMateri' => $this->subMateri->getSubMateriById($idSubMateri),
        ];
        echo view('v-header');
        return view('subMateri/v-updateSubMateri', $data);
    }
    
    public function updateSubProses()
    {
        $idMateri = $this->request->getPost('idMateri');
        $idSubMateri = $this->request->getPost('idSubMateri');

        if (!$idMateri || !$idSubMateri) {
            return redirect()->to('datasubmateri/' . $idMateri)->with('error', 'ID Materi atau Sub Materi tidak ditemukan.');
        }

        // Proses update
        $this->subMateri->update($idSubMateri, [
            'judulMateri' => $this->request->getPost('judulMateri'),
            'dataMateri' => $this->request->getPost('dataMateri'),
        ]);

        return redirect()->to('datasubmateri/' . $idMateri)->with('success', 'Materi berhasil diperbarui.');
    }


    public function deleteSub($idSubMateri)
    {
        $subMateri = $this->subMateri->where('idSubMateri', $idSubMateri)->first();
        if ($subMateri) {
            $idMateri = $subMateri['idMateri'];
            $this->subMateri->delete($idSubMateri);
            return redirect()->to(base_url('datasubmateri/' . $idMateri))->with('success', 'Materi berhasil dihapus.');
        }
    }
}
