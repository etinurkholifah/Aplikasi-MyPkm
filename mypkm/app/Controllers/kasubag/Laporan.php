<?php

namespace App\Controllers\Kasubag;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected $laporan;


    public function __construct()
    {
        $this->laporan = new LaporanModel();
    }

    public function index()
    {
        $data = [
            'dataLaporan' => $this->laporan->getAllData(),
            'page_title' => "Laporan"
        ];

        return view('kasubag/laporan', $data);
    }

    public function validasi($id)
    {
        $laporan = $this->laporan->find($id);

        if (!$laporan) {
            return redirect()->to('/kasubag/laporan')->with('error', 'Laporan tidak ditemukan');
        }

        $this->laporan->update($id, ['val_kasubag' => 'sudah']);

        return redirect()->to('/kasubag/laporan')->with('success', 'Laporan berhasil validasi');
    }

    public function batalValidasi($id)
    {
        $laporan = $this->laporan->find($id);

        if (!$laporan) {
            return redirect()->to('/kasubag/laporan')->with('error', 'Laporan tidak ditemukan');
        }

        $this->laporan->update($id, ['val_kasubag' => 'belum']);

        return redirect()->to('/kasubag/laporan')->with('success', 'Laporan berhasil batal divalidasi');
    }
    
}
