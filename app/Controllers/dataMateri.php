<?php

namespace App\Controllers;

use App\Models\masterMateri;
use App\Models\masterSubMateri;
use mysqli;

class DataMateri extends BaseController
{
    protected $materi;
    protected $subMateri;

    public function __construct()
    {
        $this->materi = new masterMateri();
        $this->subMateri = new masterSubMateri();
    }
    public function index()
    {
        $data = [
            'materi' => $this->materi->getMateriGrouped(),
        ]; 
        echo view('v-header');
        return view('materi/v-dataMateri', $data);
    }

    public function updateStatus($idMateri)
    {
        $status = $this->request->getPost('status') ? 1 : 0;
        $this->materi->update($idMateri, ['status' => $status]);
        return redirect()->to(base_url('datamateri'));

    }

    public function details($idMateri)
    {
        return redirect()->to(base_url('datasubmateri/' . $idMateri));
    }

    public function delete($idMateri)
    {
        $this->materi->delete($idMateri);
        return redirect()->to(base_url('datamateri'));
    }

    public function tambah()
    {
        echo view('v-header');
        return view('materi/v-tambahMateri');
    }

    public function tambahProses()
    {
        $idUser = session()->get('idUser');

        $this->materi->insert([
            'namaMateri' => $this->request->getPost('kategoriMateri'),
            'idUser' => $idUser,
            'status' => 0
        ]);

        return redirect()->to('datamateri')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function update($idMateri)
    {
        $data = [
            'materi' => $this->materi->getById($idMateri)->first(),
        ];
        echo view('v-header');
        return view('materi/v-updateMateri', $data);
    }
    public function updateProses()
    {
        $idUser = session()->get('idUser');
        $idMateri = $this->request->getPost('idMateri');

        if (!$idMateri) {
            return redirect()->to('datamateri')->with('error', 'ID Materi tidak ditemukan.');
        }

        $this->materi->update($idMateri,[
            'namaMateri' => $this->request->getPost('kategoriMateri'),
            'idUser' => $idUser
        ]);

        return redirect()->to('datamateri')->with('success', 'Materi berhasil ditambahkan.');
    }
}