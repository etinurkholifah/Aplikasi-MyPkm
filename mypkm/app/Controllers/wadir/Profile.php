<?php

namespace App\Controllers\Wadir;

use App\Controllers\BaseController;
use App\Models\AkademikModel;

class Profile extends BaseController
{
    protected $akademik;

    public function __construct()
    {
        $this->akademik = new AkademikModel();
    }

    public function index()
    {
        if (!session('user')) {
            return redirect()->to('/login')->with('error', 'Silakan login dahulu!');
        }

        $id = session('user')['id_akademik'];

        $data = [
            'dataAkademik' => $this->akademik->getDataById($id),
            'page_title' => 'akun'
        ];

        return view('wadir/profile', $data);
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
            'email' => $this->request->getPost('email'),
        ];

        $inputPassword = $this->request->getPost('password');

        // Memeriksa apakah input password diisi
        if (!empty($inputPassword)) {
            // Jika diisi, tambahkan password ke data
            $data['password'] = sha1($inputPassword);
        }

        $this->akademik->update($id, $data);

        return redirect()->to('wadir/profile');
    }
}
