<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LaporanModel;
use Mpdf\Mpdf;


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
            'page_title' => 'laporan'
        ];

        return view('admin/laporan', $data);
    }
}
