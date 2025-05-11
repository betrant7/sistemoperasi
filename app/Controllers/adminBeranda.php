<?php

namespace App\Controllers;

use App\Models\masterUser;
use App\Models\masterMateri;

class AdminBeranda extends BaseController
{
    protected $masterUser;    
    protected $masterMateri;
    public function __construct()
    {
        $this->masterUser = new masterUser();
        $this->masterMateri = new masterMateri();
    }
    public function index()
    {
        $data = [
            'users' => $this->masterUser->where('role', 'mahasiswa')->findAll(),
            'materi' => $this->masterMateri->findAll()
        ];
        echo view('v-header');
        return view('v-adminBeranda', $data);
    }

    public function profil()
    {

        $data = [
            'user' => $this->masterUser->find(session()->get('idUser')),
        ];
        echo view('v-header');
        return view('profil/v-adminProfil', $data);
    }

    public function editProfil()
    {
        $data = [
            'user' => $this->masterUser->find(session()->get('idUser')),
        ];
        return view('profil/v-editAdminProfil', $data);
    }

    public function editProfilProses()
    {
        $idUser = session()->get('idUser');
        $nim = $this->request->getPost('nim');
        $namaLengkap = $this->request->getPost('namaLengkap');
        $username = $this->request->getPost('username');

        $this->masterUser->update($idUser, [
            'nim' => $nim,
            'namaLengkap' => $namaLengkap,
            'username' => $username
        ]);

        return redirect()->to('/adminprofil')->with('success', 'Profil berhasil diubah');
    }

    public function UbahPassword()
    {
        $data = [
            'user' => $this->masterUser->find(session()->get('idUser')),
        ];
        return view('profil/v-editAdminPassword', $data);
    }

    public function UbahPasswordProses()
    {
        $idUser = session()->get('idUser');
        $passwordLama = $this->request->getPost('passwordLama');
        $passwordBaru = $this->request->getPost('passwordBaru');
        $passwordKonfirmasi = $this->request->getPost('passwordKonfirmasi');

        if ($passwordBaru != $passwordKonfirmasi) {
            return redirect()->to('/UbahPassword')->with('error', 'Password baru dan konfirmasi tidak sama');
        }

        $user = $this->masterUser->find($idUser);

        if ($user && $passwordLama == $user['password']) {
            // Update password baru
            $this->masterUser->update($user['idUser'], ['password' => $passwordBaru]);

            return redirect()->to('/adminprofil')->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->to('/UbahPassword')->with('error', 'Password lama tidak sesuai');
        }
    }
}