<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
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
            'dataMahasiswa' => $this->mahasiswa->getAllData(),
            'page_title' => 'mahasiswa'
        ];
        return view('admin/Mahasiswa', $data);
    }

    public function add()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'page_title' => 'mahasiswa'
        ];
        return view('admin/mahasiswaAdd', $data);
    }

    public function addProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $npm = $this->request->getPost('npm');
        $password = sha1($this->request->getPost('password'));

        $data = [
            'npm' => $npm,
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'no_hp' => $this->request->getPost('nohp'),
            'semester' => $this->request->getPost('semester'),
            'prodi' => $this->request->getPost('prodi'),
            'password' => $password,
            'status_akun' => 'nonaktif',
            'dokumen' => 'belum'
        ];

        $this->mahasiswa->save($data);
        return redirect()->to('admin/mahasiswa')->with('success', 'Data mahasiswa berhasil ditambah.');
    }

    public function edit($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'dataMahasiswa' => $this->mahasiswa->getDataById($id),
            'page_title' => 'mahasiswa'
        ];

        return view('admin/mahasiswaEdit', $data);
    }

    public function UpdateProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $id = $this->request->getPost('id');

        $inputPassword = $this->request->getPost('password');

        // Menyiapkan data lainnya untuk update
        $data = [
            'npm' => $this->request->getPost('npm'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'semester' => $this->request->getPost('semester'),
            'prodi' => $this->request->getPost('prodi'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'no_hp' => $this->request->getPost('nohp'),
        ];

        // Memeriksa apakah input password diisi
        if (!empty($inputPassword)) {
            // Jika diisi, tambahkan password ke data
            $data['password'] = sha1($inputPassword);
        }

        $this->mahasiswa->update($id, $data);

        return redirect()->to('admin/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }


    public function delete($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }
    
        try {
            $this->mahasiswa->delete($id);
            return redirect()->to('admin/mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if ($e->getCode() == 1451) {
                return redirect()->to('admin/mahasiswa')->with('error', 'Data mahasiswa sedang digunakan di tempat lain. Anda tidak dapat menghapusnya.');
            } else {
                return redirect()->to('admin/mahasiswa')->with('error', 'Terjadi kesalahan saat menghapus data mahasiswa.');
            }
        }
    }
    

    public function activateAccount($id)
    {
        $user = $this->mahasiswa->find($id);

        if (!$user) {
            return redirect()->to('/admin/mahasiswa')->with('error', 'Pengguna tidak ditemukan');
        }

        // Aktifkan status_akun
        $this->mahasiswa->update($id, ['status_akun' => 'aktif']);

        return redirect()->to('/admin/mahasiswa')->with('success', 'Status akun pengguna berhasil diaktifkan');
    }

    public function deactivateAccount($id)
    {
        $user = $this->mahasiswa->find($id);

        if (!$user) {
            return redirect()->to('/admin/mahasiswa')->with('error', 'Pengguna tidak ditemukan');
        }

        // Aktifkan status_akun
        $this->mahasiswa->update($id, ['status_akun' => 'nonaktif']);

        return redirect()->to('/admin/mahasiswa')->with('success', 'Status akun pengguna berhasil dinonaktifkan');
    }

    public function filterData()
    {
        $semester = $this->request->getPost('semester');
        $status = $this->request->getPost('status');

        // Ambil data berdasarkan filter
        $filteredData = $this->mahasiswa->getFilteredData($semester, $status);

        return $this->response->setJSON($filteredData);
    }
}
