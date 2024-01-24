<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\AkademikModel;
use App\Models\AdminModel;

class Login extends BaseController
{
    protected $admin;
    protected $akademik;
    protected $mahasiswa;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->admin = new AdminModel();
        $this->akademik = new AkademikModel();
        $this->mahasiswa = new MahasiswaModel();
    }

    public function index()
    {
        return view('login');
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->admin->authenticate($username, $password);
        $mahasiswa = $this->mahasiswa->authenticate($username, $password);
        $akademik = $this->akademik->authenticate($username, $password);

        if ($admin) {
            $userData = [
                'id' => $admin['id_admin'],
                'nama' => $admin['nama'],
                'username' => $admin['username'],
                'role' => 'admin'
            ];
            session()->set('user', $userData);
        } elseif ($mahasiswa) {
            if ($mahasiswa['status_akun'] == 'aktif') {
                $userData = [
                    'id_mahasiswa' => $mahasiswa['id_mahasiswa'],
                    'username' => $mahasiswa['npm'],
                    'nama' => $mahasiswa['nama'],
                    'role' => 'mahasiswa'
                ];

                // Set data sesi untuk mahasiswa
                session()->set('user', $userData);
            } else {
                return redirect()->to('/login')->with('error', 'Akun tidak aktif');
            }
        } elseif ($akademik) {
            // Pengguna adalah akademik
            $userData = [
                'id_akademik' => $akademik['id_akademik'],
                'nama' => $akademik['nama'],
                'username' => $akademik['username'],
                'nip' => $akademik['nip'],
                'role' => $akademik['role']
            ];
            session()->set('user', $userData);
        } else {
            return redirect()->to('/login')->with('error', 'Login failed/akun tidak aktif');
        }

        switch ($userData['role']) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'mahasiswa':
                return redirect()->to('/mahasiswa/dashboard');
            case 'KABAG':
                return redirect()->to('/kabag/dashboard');
            case 'KASUBAG':
                return redirect()->to('/kasubag/dashboard');
            case 'WADIR':
                return redirect()->to('/wadir/dashboard');
            default:
                return redirect()->to('/login')->with('error', 'Invalid role');
        }
    }

    public function logout()
    {
        // Hapus sesi pengguna dan arahkan ke halaman login
        session()->remove('user');
        return redirect()->to('/login');
    }
}
