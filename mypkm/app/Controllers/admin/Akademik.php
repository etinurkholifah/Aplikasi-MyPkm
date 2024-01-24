<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AkademikModel;

class Akademik extends BaseController
{
    protected $akademik;

    public function __construct()
    {
        $this->akademik = new AkademikModel();
    }

    public function index()
    {
        if (session()->has('user')) {
            $data = [
                'dataAkademik' => $this->akademik->getAllData(),
                'page_title' => "Akademik"
            ];
            return view('admin/akademik', $data);
        } else {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }


    public function add()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'page_title' => "Akademik"
        ];
        return view('admin/akademikAdd', $data);
    }

    public function addProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $password = sha1($this->request->getPost('password'));

        $image = $this->request->getFile('foto');
        $imageName = $image->getRandomName();
        $image->move(FCPATH . '/assets/images/akademik/', $imageName);

        $data = [
            'nip' => $this->request->getPost('nip'),
            'nama' => $this->request->getPost('nama'),
            'foto' => $imageName,
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $password,
            'role' => $this->request->getPost('role'),
        ];

        $this->akademik->save($data);
        return redirect()->to('admin/akademik')->with('success', 'Data akademik berhasil ditambah.');
    }

    public function edit($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'page_title' => "Akademik",
            'dataAkademik' => $this->akademik->getDataById($id)
        ];

        return view('admin/akademikEdit', $data);
    }

    public function UpdateProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $id = $this->request->getPost('id_akademik');

        $user = $this->akademik->find($id);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'nip' => $this->request->getPost('nip'),
            'role' => $this->request->getPost('role'),
            'email' => $this->request->getPost('email'),
        ];

        $inputPassword = $this->request->getPost('password');

        // Memeriksa apakah input password diisi
        if (!empty($inputPassword)) {
            // Jika diisi, tambahkan password ke data
            $data['password'] = sha1($inputPassword);
        }

        $image = $this->request->getFile('foto');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . '/assets/images/akademik/', $imageName);
            // Hapus foto lama, tanpa cek file sebelumnya
            if ($user['foto']) {
                @unlink(FCPATH . '/assets/images/akademik/' . $user['foto']);
            }
            $data['foto'] = $imageName;
        }

        $this->akademik->update($id, $data);

        return redirect()->to('admin/akademik')->with('success', 'Data akademik berhasil diupdate.');
    }

    public function delete($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }
        
        $user = $this->akademik->find($id);

        if ($user['foto']) {
            $file_path = FCPATH . '/assets/images/akademik/' . $user['foto'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->akademik->delete($id);

        return redirect()->to('admin/akademik')->with('success', 'Data akademik berhasil dihapus.');
    }
}
