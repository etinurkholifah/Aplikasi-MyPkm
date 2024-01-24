<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'about'
        ];

        return view('mahasiswa/about', $data);
    }
}
