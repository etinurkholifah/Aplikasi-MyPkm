<?php namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('/login/user_login');
    }

    public function login_action()
    {
        $muser = new UserModel();
        $npm = $this->request->getPost('npm');
        $password = $this->request->getPost('password');

        $cek = $muser->get_data($npm, $password);
        if ($cek !== null && ($cek['user_npm'] == $npm) && ($cek['user_password'] == $password)) {
            session()->set('logged_in', true);
            session()->set('user_email', $cek['user_email']);
            session()->set('user_npm', $cek['user_npm']);
            session()->set('user_id', $cek['user_id']);
            return redirect()->to(base_url('home/index'));
        } else {
            session()->setFlashdata('gagal', 'Username / Password salah');
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function register()
    {
        return view('login/register');
    }


    public function reg_action()
    {
        $muser = new UserModel();

        $validation = $this->validate([
            'user_npm' => 'required',
            'user_email' => 'required|valid_email',
            'user_password' => 'required|min_length[6]',
        ]);

        if (!$validation) {
            $errors = \Config\Services::validation()->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $data = [
            'user_npm' => $this->request->getPost('user_npm'),
            'user_email' => $this->request->getPost('user_email'),
            'user_password' => $this->request->getPost('user_password'),
        ];

        if (!$muser->save($data)) {
            $errors = $muser->errors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        session()->setFlashdata('success', 'Registration successful. Please login.');
        return redirect()->to(base_url('login'));
    }
}