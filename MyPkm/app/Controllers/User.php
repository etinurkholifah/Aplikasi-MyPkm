<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
    
        if (session()->get('user_npm') === '') {
            session()->setFlashdata('gagal', 'Silakan login untuk mengakses halaman ini.');
            return redirect()->to(base_url('login'));
        }

        return view('Home/index');
    }

    public function Require()
    {
        helper('my');
        requireLogin(); 
    }
}