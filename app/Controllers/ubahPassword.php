<?php

namespace App\Controllers;
use App\Models\masterUser;


class ubahPassword extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = new masterUser();
    }
    public function index()
    {
        return view('home/v-verifikasi');
    }

    public function verifikasi()
    {
        $email = $this->request->getVar('email');
        $user = $this->db->where('email', $email)->first();

        if ($user) {
            // Simpan email di session sementara
            session()->set('email_ubah', $email);
                return redirect()->to('/ubahpassword');
        } else {
            return redirect()->to('/verifikasi')->with('error', 'Email tidak ditemukan');
        }
    }

    public function ubahPassword()
    {
        return view('home/v-ubahPassword');
    }
    // Proses ubah password
    public function proses()
    {
        $sessionEmail = session()->get('email_ubah');
        if (!$sessionEmail) {
            return redirect()->to('/verifikasi')->with('error', 'Silakan verifikasi email terlebih dahulu');
        }

        $passwordLama = $this->request->getVar('passwordLama');
        $passwordBaru = $this->request->getVar('passwordBaru');
        $passwordKonfirmasi = $this->request->getVar('passwordKonfirmasi');

        if ($passwordBaru != $passwordKonfirmasi) {
            return redirect()->to('/ubahpassword')->with('error', 'Password baru dan konfirmasi tidak sama');
        }

        $user = $this->db->where('email', $sessionEmail)->first();

        if ($user) {
            $passwordTersimpan = $user['password'];
    
            // Hitung persentase kemiripan
            similar_text($passwordLama, $passwordTersimpan, $persentaseKemiripan);
    
            if ($passwordLama === $passwordTersimpan || $persentaseKemiripan >= 80) {
                // Update password baru
                $this->db->update($user['idUser'], ['password' => $passwordBaru]);
    
                session()->remove('email_ubah'); // Hapus email dari session
                return redirect()->to('/login')->with('success', 'Password berhasil diubah');
            } else {
                return redirect()->to('/ubahpassword')->with('error', 'Password lama tidak sesuai atau terlalu berbeda');
            }
        } else {
            return redirect()->to('/ubahpassword')->with('error', 'Akun tidak ditemukan');
        }    }
}