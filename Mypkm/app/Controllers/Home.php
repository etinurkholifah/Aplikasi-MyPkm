<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'DASHBOARD ADMIN'
         ];
 
         echo view('layout/layoutheader', $data);
         echo view('layout/layoutsidebar');
         echo view('layout/layouttopbar');
         echo '<div class="text-center"><h1 class="h3 mb-4 text-gray-800">' . $data['judul'] . '</h1></div>';
         echo view('layout/layoutfooter');
         
    }
}