<?php

namespace App\Controllers;
use App\Models\masterUser;


class Register extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = new masterUser();
    }
    public function index()
    {
        return view('v-register');
    }
    public function registerProses()
    {
        $post = $this->request->getPost();
        
        if (!$this->validate([
            'email' => 'required|valid_email',
            'nim' => 'required|regex_match[/^[0-9]{2}3307[0-9]{3}$/]',
            'namaLengkap' => 'required',
            'username' => 'required',
            'password' => 'required'
        ])) {
            return redirect()->back()->with('error', 'Data tidak sesuai, mohon periksa kembali!');
        }
        $existingUser = $this->db->getData($post['username']);
        $existingEmail = $this->db->getData($post['email']);
        if ($existingUser || $existingEmail) {
            return redirect()->back()->with('error', 'Username / Email sudah digunakan!');
        }

        $data = [
            'email' => $post['email'],
            'nim' => $post['nim'],
            'namaLengkap' => $post['namaLengkap'],
            'username' => $post['username'],
            'password' => $post['password'],
            'kelas' => $post['kelas'],
            'role' => 'mahasiswa'
        ];
        $this->db->saveUser($data);
        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silahkan login');
    }
}