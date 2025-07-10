<?php

namespace App\Controllers;

use App\Models\masterUser;
use Google_Client;
use Google_Service_Oauth2;

class Home extends BaseController
{
    protected $db;
    protected $googleClient;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId('701082620157-nqj50ilv7c0op5pc3gsngc3vrocedplf.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
<<<<<<< HEAD
        $this->googleClient->setRedirectUri('http://localhost:8080/login/logingoogle');
=======
        $this->googleClient->setRedirectUri('https://ujicobavps.cloud/login/logingoogle');
>>>>>>> 5e287a0fccc78f4c044d859ee10e8bd339309165
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
        $this->db = new masterUser();
    }

    public function index()
    {
        return redirect()->to(base_url('login'));
    }

    public function login()
    {
        $data = [
            'link' => $this->googleClient->createAuthUrl()
        ];
        if (session('role')) {
            return redirect()->to('beranda');
        }
        return view('home/v-login', $data);
    }

    public function loginProses()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('user')->where('email', $post['email'])->orWhere('nim', $post['email'])->orWhere('username', $post['email'])->get();
        $user = $query->getRow();

        if ($user) {
            if ($post['password'] == $user->password) {
                // Update status menjadi aktif
                $this->db->update($user->idUser, ['status' => 'aktif']);
                
                if ($user->role == 'dosen') {
                    $params = ['idUser' => $user->idUser, 'role' => $user->role, 'namaLengkap' => $user->namaLengkap, 'status' => 'aktif'];
                    session()->set($params);
                    return redirect()->to('/adminberanda');
                } elseif ($user->role == 'mahasiswa') {
                    $params = ['idUser' => $user->idUser, 'role' => $user->role, 'namaLengkap' => $user->namaLengkap, 'nim' => $user->nim, 'status' => 'aktif'];
                    session()->set($params);
                    return redirect()->to('/beranda');
                } else {
                    return redirect()->to('/login')->with('error', 'Password salah!');
                }
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak sesuai');
        }
    }

    public function loginGoogle()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));

        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();

            if (!isset($data['email']) || !isset($data['name'])) {
                return redirect()->to('/login')->with('error', 'Data Google tidak valid.');
            }

            // ambil user berdasarkan email
            $user = $this->db->where('email', $data['email'])->first();

            if ($user) {
                // Update status menjadi aktif
                $this->db->update($user['idUser'], ['status' => 'aktif']);
                
                $params = [
                    'idUser' => $user['idUser'],
                    'namaLengkap' => $user['namaLengkap'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'status' => 'aktif'
                ];
            } else {
                $role = (strpos($data['email'], '@pnm.ac.id') !== false) ? 'dosen' : 'mahasiswa';
                $newUser = [
                    'namaLengkap' => $data['name'],
                    'email' => $data['email'],
                    'role' => $role,
                    'status' => 'aktif'
                ];
                $this->db->insert($newUser);
                $params = [
                    'idUser' => $this->db->insertID(),
                    'namaLengkap' => $data['name'],
                    'email' => $data['email'],
                    'role' => $role,
                    'status' => 'aktif'
                ];
            }

            session()->set($params);

            if ($params['role'] === 'dosen') {
                return redirect()->to('/adminberanda');
            } else {
                return redirect()->to('/beranda');
            }
        }

        return redirect()->to('/login')->with('error', 'Autentikasi Google gagal.');
    }

    public function logout()
    {
        $session = session();
        $userId = $session->get('idUser');

        if ($userId) {
            $this->db->update($userId, ['status' => 'tidak aktif']);
           
            $session->destroy();
            return redirect()->to('/')->with('success', 'Anda telah logout.');
        }
    }

}
