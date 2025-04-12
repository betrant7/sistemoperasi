<?php

namespace App\Controllers;

class AdminBeranda extends BaseController
{
    public function index()
    {
        echo view('v-header');
        return view('v-adminBeranda');
    }
}