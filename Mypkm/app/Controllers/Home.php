<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'DASBORD ADMIN'
        ];

        echo view('layoutadmin/layoutheader', $data);
        echo view('layoutadmin/layoutsidebar');
        echo view('layoutadmin/layouttopbar');
        echo view('home/index');
        echo view('layoutadmin/layoutfooter');
    }
}
