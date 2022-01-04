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
        $getPost = $this->request->getPost();
        var_dump($getPost);
    }
}
