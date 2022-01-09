<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BuyItemController extends BaseController
{
    public function index($sale_id = null)
    {
        // session / model 宣言
        $session = session();
        $addressModel = model('AddressModel');
        $saleModel = model('SaleModel');

        $user_id = $session->get('user_id');
        $saleInfo = $saleModel->find($sale_id);                
        if (empty($saleInfo)) {
            return "존재하지 않는 상품입니다!";            
        }

        $addresses = $addressModel->where('user_id', $user_id)
                    ->findAll();                
        echo view('buy/paymentPage', [
            'addresses' => $addresses,
            'saleInfo'  => $saleInfo,
        ]);
    }

    public function payment($id = null)
    {
        // session / model/ service 宣言
        $session = session();
        $paymentModel = model('paymentModel');
        $validation = service('validation');
                
        $getPost = $this->request->getPost();
        $getPost['sale_id'] = $id;
        $getPost['user_id'] = $session->get('user_id');
        

        $is_validate = $validation->run($getPost, 'payment');
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('buy/paymentPage', [
                'errors' => $errors,                
            ]);
            return;
        }

        $insertData = [
            'user_id'        => $getPost['user_id'],
            'sale_id'        => $getPost['sale_id'],
            'address_id'     => $getPost['address_id'],
            'payment_amount' => $getPost['payment_amount'],
        ];
        $insert_id = $paymentModel->insert($insertData);
        
        if (!$insert_id) {
            return "Error : can't insert";            
        }

        echo '주문결과 확인페이지';      
    }
}
