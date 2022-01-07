<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BuyItemController extends BaseController
{
    public function index()
    {
        echo view('buy/paymentPage');
    }

    // public function buyItem($id = null)
    // {
    //     $sale_id = $id;

    // }

    public function address()
    {
        echo view('buy/index_utf8');
    }

    public function addressPopup()
    {
        echo view('buy/jusoPopup_utf8');
    }    
}
