<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {        
        $session = session();
        $userModel = model('UserModel');

        $user = $userModel->find($session->get('user_id'));

        echo view('dashboard/cropImageForm', [
            'user' => $user
        ]);
    }
}
