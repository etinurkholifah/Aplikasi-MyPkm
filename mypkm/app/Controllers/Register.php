<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Register extends BaseController
{
    protected $mahasiswa;

    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
    }

    public function index()
    {
        return view('register');
    }

    public function processRegister()
    {
        $npm = $this->request->getPost('npm');
        $password = sha1($this->request->getPost('password'));

        $data = [
            'npm' => $npm,
            'nama' => $this->request->getPost('nama'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'no_hp' => $this->request->getPost('nohp'),
            'password' => $password,
            'status_akun' => 'nonaktif',
            'dokumen' => 'belum'
        ];

        $this->mahasiswa->save($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to('login');
    }
}
