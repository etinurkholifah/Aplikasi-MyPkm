<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $model = new MahasiswaModel();
        $dokumenStatus = $model->countDokumenStatus();

        $data = [
            'mahasiswa' => $model->getDataBySemester(),
            'sudahDokumen' => (!empty($dokumenStatus)) ? $dokumenStatus[0]['sudah_dokumen'] : 0,
            'belumDokumen' => (!empty($dokumenStatus)) ? $dokumenStatus[0]['belum_dokumen'] : 0,
            'page_title' => 'dashboard',
        ];

        return view('admin/dashboard', $data);
    }
}
