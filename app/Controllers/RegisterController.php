<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RegisterController extends BaseController
{
    public function index()
    {
        echo view('auth/registerForm');
    }

    public function register()
    {
        $validation = service('validation');
        $getPost = $this->request->getPost();

        $is_validation = $validation->run($getPost, 'register');

        if (!$is_validation) {
            $errors = $validation->getErrors();
            echo view('auth/registerForm', [
                'errors' => $errors
            ]);
            exit;
        }

        $data = [
            'user_name'     => $getPost['user_name'],
            'user_email'    => $getPost['user_email'],
            'user_password' => password_hash($getPost['user_password'], PASSWORD_DEFAULT) 
        ];

        $userModel = model('UserModel');
        $insertResult = $userModel->insert($data);

        if (!$insertResult) {
            echo "실패";
        }

        return redirect()->to(base_url('login?URL='.base_url()));
    }
}
