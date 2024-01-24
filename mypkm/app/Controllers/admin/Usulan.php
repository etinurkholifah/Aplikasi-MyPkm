<?php

namespace App\Controllers\Admin;

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
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'dataUsulan' => $this->usulan->getDataJoin(),
            'page_title' => "Usulan"
        ];

        return view('admin/dataUsulan', $data);
    }

    public function add()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'dataMahasiswa' => $this->mahasiswa->getAllData(),
            'page_title' => 'usulan'
        ];

        return view('admin/usulanAdd', $data);
    }

    public function addProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $mahasiswaData = [
            'dokumen' => 'sudah'
        ];

        $usulanData = [
            'skema' => $this->request->getPost('skema'),
            'judul' => $this->request->getPost('judul'),
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'id_mahasiswa' => $this->request->getPost('mahasiswa'),
            'id_belmawa' => $this->request->getPost('id_belmawa'),
            'proposal' => $this->handleFileUpload('proposal', [], 'assets/file/proposal'),
        ];

        try {
            // Tambahkan data ke tabel usulan
            $this->usulan->insert($usulanData);

            // Tambahkan data ke tabel mahasiswa
            $this->mahasiswa->update(['id_mahasiswa' => $usulanData['id_mahasiswa']], $mahasiswaData); // Perubahan ini

            return redirect()->to('admin/usulan')->with('success', 'Data usulan berhasil ditambah.');
        } catch (\Exception $e) {
            log_message('error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());

            return redirect()->to('admin/usulan');
        }
    }

    private function handleFileUpload($fieldName, $existingData, $path)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

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

    public function update($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'dataMahasiswa' => $this->mahasiswa->getAllData(),
            'dataUsulan'=> $this->usulan->getDataById($id),
            'page_title' => 'usulan'
        ];

        return view('admin/usulanUpdate', $data);
    }

    public function UpdateProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $idUsulan = $this->request->getPost('id_usulan');
        $id_mahasiswa = $this->request->getPost('id_mahasiswa');
        $existingData = $this->usulan->find($idUsulan);

        $mahasiswaData = [
            'dokumen' => 'sudah'
        ];

        $usulanData = [
            'judul' => $this->request->getPost('judul'),
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'id_mahasiswa' => $this->request->getPost('mahasiswa'),
            'id_belmawa' => $this->request->getPost('id_belmawa') ?: $existingData['id_belmawa'],
            'proposal' => $this->handleFileUpload('proposal', $existingData, 'assets/file/proposal/'),
        ];

        // Periksa apakah ada perubahan aktual pada tabel usulan
        $usulanDataChanges = array_diff_assoc($usulanData, $existingData);

        // Periksa apakah ada perubahan aktual pada tabel mahasiswa
        $mahasiswaDataChanges = array_diff_assoc($mahasiswaData, $existingData);

        try {
            if (!empty($usulanDataChanges)) {
                $this->usulan->update(['id_usulan' => $idUsulan], $usulanDataChanges);
            }

            if (!empty($mahasiswaDataChanges)) {
                $this->mahasiswa->update(['id_mahasiswa' => $id_mahasiswa], $mahasiswaDataChanges);
            }

            return redirect()->to('admin/usulan')->with('success', 'Data usulan berhasil diupdate.');
        } catch (\Exception $e) {
            log_message('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());

            return redirect()->to('admin/usulan');
        }
    }

    public function delete($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $existingData = $this->usulan->find($id);

        $mahasiswaId = $existingData['id_mahasiswa'];

        $proposalPath = FCPATH . 'assets/file/proposal/' . $existingData['proposal'];

        if (!empty($existingData['proposal']) && file_exists($proposalPath)) {
            unlink($proposalPath);
        }

        // Perbarui kolom dokumen di tabel tb_mahasiswa
        $this->mahasiswa->update($mahasiswaId, ['dokumen' => 'belum']);

        $this->usulan->delete($id);

        return redirect()->to('admin/usulan')->with('success', 'Data usulan berhasil dihapus.');
    }


    public function detail($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }
        
        $data = [
            'dataMahasiswa' => $this->mahasiswa->getAllData(),
            'dataUsulan' => $this->usulan->getDataById($id),
            'page_title' => 'usulan'
        ];

        return view('admin/usulanDetail', $data);
    }

}
