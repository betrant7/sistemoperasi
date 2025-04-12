<?php

namespace App\Controllers;
use App\Models\masterUser;


class LengkapiData extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = new masterUser();
    }
    public function index()
    {
        $idUser = session()->get('idUser');

        $data = [
            'user' => $this->db->find($idUser),
        ];
        return view('v-lengkapidata', $data);
    }

    public function updateDataProses()
    {
        $post = $this->request->getPost();
        $idUser = session()->get('idUser');

        if (!$this->validate([
            'nim' => 'required|regex_match[/^[0-9]{2}3307[0-9]{3}$/]',
            'namaLengkap' => 'required',
            'username' => 'required',
            'password' => 'required',
            'kelas' => 'required'
        ])) {
            return redirect()->back()->with('error', 'Data tidak sesuai, mohon periksa kembali!');
        }
        $data = [
            'nim' => $post['nim'],
            'namaLengkap' => $post['namaLengkap'],
            'username' => $post['username'],
            'password' => $post['password'],
            'kelas' => $post['kelas'],
            'role' => 'mahasiswa'
        ];

        $this->db->update($idUser, $data);

        session()->set($data);

        return redirect()->to('/beranda')->with('success', 'Data berhasil diperbarui!');
    }

}