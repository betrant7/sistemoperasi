<?php

namespace App\Controllers\Frondend;
use App\Controllers\BaseController;

class PilihOS extends BaseController
{
    public function index()
    {
        echo view('frondend/v-header');
        return view('frondend/v-pilihOS');
    }
}