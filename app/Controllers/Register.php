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
        return view('home/v-register');
    }
    public function registerProses()
    {
        $post = $this->request->getPost();
        
        // Basic validation for all users
        if (!$this->validate([
            'email' => 'required|valid_email',
            'namaLengkap' => 'required', 
            'username' => 'required',
            'password' => 'required'
        ])) {
            return redirect()->back()->with('error', 'Data tidak sesuai, mohon periksa kembali!');
        }

        // Check if email is from pnm.ac.id domain
        if (strpos($post['email'], '@pnm.ac.id') !== false) {
            // Dosen validation
            if (!$this->validate([
                'nim' => 'required'
            ])) {
                return redirect()->back()->with('error', 'Data tidak sesuai, mohon periksa kembali!');
            }
        } else {
            // Mahasiswa validation with NIM regex
            if (!$this->validate([
                'nim' => 'required|regex_match[/^[0-9]{2}3307[0-9]{3}$/]'
            ])) {
                return redirect()->back()->with('error', 'Format NIM tidak sesuai!');
            }
        }

        $existingUser = $this->db->getData($post['username']);
        $existingEmail = $this->db->getData($post['email']);
        if ($existingUser || $existingEmail) {
            return redirect()->back()->with('error', 'Username / Email sudah digunakan!');
        }

        if (strpos($post['email'], '@pnm.ac.id') !== false) {
            $data = [
                'email' => $post['email'],
                'nim' => $post['nim'],
                'namaLengkap' => $post['namaLengkap'], 
                'username' => $post['username'],
                'password' => $post['password'],
                'role' => 'dosen',
                'status' => 'tidak aktif'
            ];
        } else {
            $data = [
                'email' => $post['email'],
                'nim' => $post['nim'],
                'namaLengkap' => $post['namaLengkap'],
                'username' => $post['username'],
                'password' => $post['password'],
                'kelas' => $post['kelas'],
                'role' => 'mahasiswa', 
                'status' => 'tidak aktif'
            ];
        }
        $this->db->saveUser($data);
        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silahkan login');
    }
}