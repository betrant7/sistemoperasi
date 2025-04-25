<?php

namespace App\Controllers;

use App\Models\masterUser;
use App\Models\masterMateri;

class AdminBeranda extends BaseController
{
    protected $user;    
    protected $materi;
    public function __construct()
    {
        $this->user = new masterUser();
        $this->materi = new masterMateri();
    }
    public function index()
    {
        $data = [
            'users' => $this->user->where('role', 'mahasiswa')->findAll(),
            'materi' => $this->materi->findAll()
        ];
        echo view('v-header');
        return view('v-adminBeranda', $data);
    }
}