<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AddressController extends BaseController
{
    public function index()
    {
        //
    }

    public function address()
    {
        echo view('buy/index_utf8');
    }

    public function addressPopup()
    {
        echo view('buy/jusoPopup_utf8');
    }
    
    public function store()
    {
        // session / service / model 선언
        $session = session();
        $validation = service('validation');
        $addressModel = model('AddressModel');

        $getPost = $this->request->getPost();
        $getPost['user_id'] = $session->get('user_id');

        $is_validate = $validation->run($getPost, 'address');
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('buy/payment', [
                'errors' => $errors
            ]);
        }

        $insertData = [
            'user_id'     => $getPost['user_id'],
            'fullAddress' => $getPost['fullAddress'],
            'zipNo'       => $getPost['zipNo'],
        ];

        $insert_id = $addressModel->insert($insertData);
        if (!$insert_id) {
            echo "Error: can't insert";
        }

        $address = $addressModel->find($insert_id);
        var_dump($address);
        // echo view('buy/addressList', [
        //     'address' => $address
        // ])
    }
}
