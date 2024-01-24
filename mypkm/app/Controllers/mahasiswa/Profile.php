<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Profile extends BaseController
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

        $id = session('user')['id_mahasiswa'];

        $data = [
            'dataMahasiswa' => $this->mahasiswa->getDataById($id),
            'page_title' => 'akun'
        ];

        return view('mahasiswa/profile', $data);
    }

    public function UpdateProses()
    {
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

        return redirect()->to('mahasiswa/profile')->with('success','Profil berhasil di perbarui');
    }
}
