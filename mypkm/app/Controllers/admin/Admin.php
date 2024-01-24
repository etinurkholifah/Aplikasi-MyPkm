<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;


class Admin extends BaseController
{

    protected $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'dataAdmin' => $this->admin->getAllData(),
            'page_title' => "Administrator"
        ];

        return view('admin/admin', $data);
    }

    public function add()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'page_title' => 'admin'
        ];

        return view('admin/adminAdd', $data);
    }

    public function addProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $password = sha1($this->request->getPost('password'));

        $image = $this->request->getFile('foto');
        $imageName = $image->getRandomName();
        $image->move(FCPATH . '/assets/images/admin/', $imageName);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'foto' => $imageName,
            'username' => $this->request->getPost('username'),
            'password' => $password,
            'role' => 'administrator',
            'status' => 'OFF',
        ];

        $this->admin->save($data);
        return redirect()->to('admin/Admin')->with('success', 'Data administrator berhasil ditambah.');
    }

    public function edit($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $data = [
            'dataAdmin' => $this->admin->getDataById($id),
            'page_title' => 'admin'
        ];

        return view('admin/adminEdit', $data);
    }

    public function UpdateProses()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $id = $this->request->getPost('id_admin');

        $inputPassword = $this->request->getPost('password');
        $user = $this->admin->find($id);


        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
        ];

        // Memeriksa apakah input password diisi
        if (!empty($inputPassword)) {
            // Jika diisi, tambahkan password ke data
            $data['password'] = sha1($inputPassword);
        }

        $image = $this->request->getFile('foto');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . '/assets/images/admin/', $imageName);
            // Hapus foto lama, tanpa cek file sebelumnya
            if ($user['foto']) {
                @unlink(FCPATH . '/assets/images/admin/' . $user['foto']);
            }
            $data['foto'] = $imageName;
        }

        $this->admin->update($id, $data);

        return redirect()->to('admin/admin')->with('success', 'Data administrator berhasil diupdate.');
    }

    public function userDelete($id)
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $user = $this->admin->find($id);

        if ($user['foto']) {
            $file_path = FCPATH . '/assets/images/admin/' . $user['foto'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->admin->delete($id);

        return redirect()->to('admin/admin')->with('success', 'Data administrator berhasil dihapus.');
    }
}
