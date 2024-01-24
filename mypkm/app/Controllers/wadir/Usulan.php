<?php

namespace App\Controllers\Wadir;

use App\Controllers\BaseController;
use App\Models\UsulanModel;
use App\Models\MahasiswaModel;

class Usulan extends BaseController
{
    protected $usulan;
    protected $mahasiswa;

    public function __construct()
    {
        $this->usulan = new UsulanModel();
        $this->mahasiswa = new MahasiswaModel();
    }

    public function index()
    {
        $data = [
            'dataUsulan' => $this->usulan->getDataJoin(),
            'page_title' => "Usulan"
        ];

        return view('wadir/dataUsulan', $data);
    }


    public function detail($id)
    {
        $data = [
            'dataMahasiswa' => $this->mahasiswa->getAllData(),
            'dataUsulan' => $this->usulan->getDataById($id),
            'page_title' => 'usulan'
        ];

        return view('wadir/usulanDetail', $data);
    }

    public function uploadDocument()
    {
        $idUsulan = $this->request->getPost('id_usulan');
        $existingData = $this->usulan->find($idUsulan);

        $usulanData = [
            'laporan' => $this->handleFileUpload('laporan', $existingData, 'assets/file/laporan/')
        ];

        // Periksa apakah ada perubahan aktual pada tabel usulan
        $usulanDataChanges = array_diff_assoc($usulanData, $existingData);

        try {
            if (!empty($usulanDataChanges)) {
                $this->usulan->update(['id_usulan' => $idUsulan], $usulanDataChanges);
            }

            return redirect()->to('wadir/usulan/detail'.$idUsulan);
        } catch (\Exception $e) {
            log_message('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());

            return redirect()->to('wadir/usulan/detail'.$idUsulan);
        }
    }


    private function handleFileUpload($fieldName, $existingData, $path)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            $randomName = $fieldName . '_' . md5(uniqid(rand(), true)) . '.' . $file->getClientExtension();
            $file->move(FCPATH . $path, $randomName);

            if (!empty($existingData[$fieldName])) {
                $existingFilePath = FCPATH . $path . $existingData[$fieldName];
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }

            return $randomName;
        }

        return $existingData[$fieldName];
    }

    public function validasi($id)
    {
        $usulan = $this->usulan->find($id);

        if (!$usulan) {
            return redirect()->to('/wadir/usulan')->with('error', 'Pengguna tidak ditemukan');
        }

        $this->usulan->update($id, ['val_wadir' => 'sudah']);

        return redirect()->to('/wadir/usulan')->with('success', 'Status akun pengguna berhasil validasi');
    }

    public function batalValidasi($id)
    {
        $usulan = $this->usulan->find($id);

        if (!$usulan) {
            return redirect()->to('/wadir/usulan')->with('error', 'Pengguna tidak ditemukan');
        }

        $this->usulan->update($id, ['val_wadir' => 'belum']);

        return redirect()->to('/wadir/usulan')->with('success', 'Status akun pengguna berhasil validasi');
    }
}
