<?php

namespace App\Controllers\Wadir;

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
            'sudahDokumen' => (!empty($dokumenStatus)) ? $dokumenStatus[0]['sudah_dokumen'] : 0,
            'belumDokumen' => (!empty($dokumenStatus)) ? $dokumenStatus[0]['belum_dokumen'] : 0,
            'mahasiswa' => $model->getDataBySemester(),
            'page_title' => 'dashboard',
        ];

        return view('wadir/dashboard', $data);
    }
}
