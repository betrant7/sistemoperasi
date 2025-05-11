<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;
use App\Models\masterUser;

class Profil extends BaseController
{
    protected $masterUser;
    public function __construct()
    {
        $this->masterUser = new masterUser();
    }
    public function index()
    {
        $data = [
            'user' => $this->masterUser->find(session()->get('idUser')),
        ];
        echo view('frondend/v-header');
        return view('frondend/v-user', $data);
    }

    public function editProfil()
    {
        $data = [
            'user' => $this->masterUser->find(session()->get('idUser')),
        ];
        return view('frondend/v-editProfil', $data);
    }
    public function updateProfil()
    {
        $idUser = session()->get('idUser');
        $nim = $this->request->getPost('nim');
        $namaLengkap = $this->request->getPost('namaLengkap');
        $kelas = $this->request->getPost('kelas');
        $username = $this->request->getPost('username');

        $this->masterUser->update($idUser, [
            'nim' => $nim,
            'namaLengkap' => $namaLengkap,
            'kelas' => $kelas,
            'username' => $username
        ]);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diubah');
    }
    public function updatePassword()
    {
        $data = [
            'user' => $this->masterUser->find(session()->get('idUser')),
        ];
        return view('frondend/v-editPassword', $data);
    }
    public function updatePasswordProses()
    {
        $idUser = session()->get('idUser');
        $passwordLama = $this->request->getVar('passwordLama');
        $passwordBaru = $this->request->getVar('passwordBaru');
        $passwordKonfirmasi = $this->request->getVar('passwordKonfirmasi');

        if ($passwordBaru != $passwordKonfirmasi) {
            return redirect()->to('/ubahPassword')->with('error', 'Password baru dan konfirmasi tidak sama');
        }

        $user = $this->masterUser->find($idUser);

        if ($user && $passwordLama == $user['password']) {
            // Update password baru
            $this->masterUser->update($user['idUser'], ['password' => $passwordBaru]);

            return redirect()->to('/profil')->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->to('/ubahPassword')->with('error', 'Password lama tidak sesuai');
        }
    }
}