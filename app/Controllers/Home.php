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
        $this->googleClient->setRedirectUri('http://localhost:8080/login/logingoogle');
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
        return view('v-login', $data);
    }

    public function loginProses()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('user')->where('email', $post['email'])->orWhere('nim', $post['email'])->orWhere('username', $post['email'])->get();
        $user = $query->getRow();


        if ($user) {
            if ($post['password'] == $user->password) {
                if ($user->role == 'dosen') {
                    $params = ['idUser' => $user->idUser, 'role' => $user->role, 'namaLengkap' => $user->namaLengkap];
                    session()->set($params);
                    return redirect()->to('/adminberanda');
                } elseif ($user->role == 'mahasiswa') {
                    $params = ['idUser' => $user->idUser, 'role' => $user->role, 'namaLengkap' => $user->namaLengkap, 'nim' => $user->nim];
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
                $params = [
                    'idUser' => $user['idUser'],
                    'namaLengkap' => $user['namaLengkap'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
            } else {
                $role = (strpos($data['email'], '@pnm.ac.id') !== false) ? 'dosen' : 'mahasiswa';
                $newUser = [
                    'namaLengkap' => $data['name'],
                    'email' => $data['email'],
                    'role' => $role
                ];
                $this->db->insert($newUser);
                $params = [
                    'idUser' => $this->db->insertID(),
                    'namaLengkap' => $data['name'],
                    'email' => $data['email'],
                    'role' => $role
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
        $session->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

}
