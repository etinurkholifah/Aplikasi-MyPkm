<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $UserModel = new \App\Models\UserModel();
        $login = $this->request->getPost('login');
        if ($login) {
            $user_name =$this->request->getPost('user_name');
            $user_pass =$this->request->getPost('user_pass');

            if($user_name == '' or $user_pass == '') {
                $err = "Silakan Masukan Username dan Password";

            }
            if ($err){
                session()->setFlashdata ('error', $err);
                return redirect()->to("login");
                
            }
        }
        return view('login/user_login');
    }
}
