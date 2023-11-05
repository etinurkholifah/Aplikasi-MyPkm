<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Mahasiswa;

class Mahasiswa extends Controller{
    public function index()
    {
        $model = new M_Mahasiswa();

        $data = [
            'judul' => 'Data Mahasiswa',
            'mahasiswa' => $model->getAllData()
        ];

        echo view('layoutadmin/layoutheader', $data);
        echo view('layoutadmin/layoutsidebar');
        echo view('layoutadmin/layouttopbar');
        echo view('mahasiswa/index', $data);
        echo view('layoutadmin/layoutfooter');

    }
}