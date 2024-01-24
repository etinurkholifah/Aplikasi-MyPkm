<?php

namespace App\Controllers\Kabag;

use App\Controllers\BaseController;
use App\Models\UsulanModel;
use App\Models\MahasiswaModel;

class Dashboard extends BaseController
{
    protected $mahasiswa;

    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
    }
    public function index()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'page_title' => 'dashboard',
            'DokumenSudah' => $this->mahasiswa->countMahasiswaWithDokumenSudah(),
            'DokumenBelum' => $this->mahasiswa->countMahasiswaWithDokumenBelum()
        ];

        return view('kabag/dashboard', $data);
    }
}
