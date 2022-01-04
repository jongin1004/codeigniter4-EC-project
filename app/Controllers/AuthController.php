<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function index()
    {
        echo view('auth/loginForm');
    }

    public function authentication()
    {
        $session = session();
        $userModel = model('UserModel');
        $url = $this->request->getVar('URL');
        $user_email = $this->request->getPost('user_email');
        $user_password = $this->request->getPost('user_password');
        
        $user = $userModel->where('user_email', $user_email)->first();
        if ($user) {
            $db_password = $user['user_password'];
            $verify_pass = password_verify($user_password, $db_password);
            if ($verify_pass) {
                $session_data = [
                    'user_id'    => $user['user_id'],
                    'user_name'  => $user['user_name'],
                    'user_email' => $user['user_email'],
                    'is_login'   => true
                ];

                $session->set($session_data);
                return redirect()->to($url);
            } else {
                $session->setFlashdata('msg', 'Wrong Email or Password');
                return redirect()->to(base_url('login?URL='.$url));
            }
        } else {
            $session->setFlashdata('msg', 'Wrong Email or Password');
            return redirect()->to(base_url('login?URL='.$url));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->back();
    }
}
