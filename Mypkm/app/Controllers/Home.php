<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Homepage'
        ];

        echo view('layout/layoutheader', $data);
        echo view('layout/layoutsidebar');
        echo view('layout/layouttopbar');
        echo view('home/index');
        echo view('layout/layoutfooter');
    }
}
