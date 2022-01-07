<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BuyItemController extends BaseController
{
    public function index()
    {
        $session = session();
        $addressModel = model('AddressModel');

        $user_id = $session->get('user_id');
        $addresses = $addressModel->where('user_id', $user_id)
                    ->findAll();

        echo view('buy/paymentPage', [
            'addresses' => $addresses
        ]);
    }

    // public function buyItem($id = null)
    // {
    //     $sale_id = $id;

    // }     
}
