<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->has('user')) {
            $data = [
                'page_title' => 'dashboard'
            ];
            return view('mahasiswa/dashboard', $data);
        } else {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}
