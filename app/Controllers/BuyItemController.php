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

        // 存在する商品かどうかを確認
        $user_id = $session->get('user_id');
        $saleInfo = $saleModel->find($sale_id);                
        if (empty($saleInfo)) {
            echo "<script> alert('間違った接近です。');window.location.assign('".previous_url()."');</script>";        
        }
        // ユーザーのaddressを読み込み
        $addresses = $addressModel->where('user_id', $user_id)
                    ->findAll();
        echo view('buy/paymentPage', [
            'addresses' => $addresses,
            'saleInfo'  => $saleInfo,
        ]);
    }

    public function payment($sale_id = null)
    {
        // session / model/ service 宣言
        $session = session();
        $paymentModel = model('paymentModel');
        $saleModel = model('SaleModel');
        $validation = service('validation');
                
        // get the data of POST
        $getPost = $this->request->getPost();
        $getPost['sale_id'] = $sale_id;
        $getPost['user_id'] = $session->get('user_id');
        
        // check validate
        $is_validate = $validation->run($getPost, 'payment');
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('buy/paymentPage', [
                'errors' => $errors,                
            ]);
            return;
        }

        // insert 
        $insertData = [
            'user_id'        => $getPost['user_id'],
            'sale_id'        => $getPost['sale_id'],
            'address_id'     => $getPost['address_id'],
            'payment_amount' => $getPost['payment_amount'],
        ];
        $insert_id = $paymentModel->insert($insertData);        
        if (!$insert_id) {
            echo "<script> alert('決済に失敗しました。');window.location.assign('".previous_url()."');</script>";          
        }

        // 商品が販売されたことをslae_postテーブルに入力
        $updateData = [
            'is_saled' => 'y',
        ];
        $updateResult = $saleModel->update($sale_id, $updateData);
        if (!$updateResult) {
            echo "<script> alert('Updateに失敗しました。');window.location.assign('".previous_url()."');</script>"; 
        }        
        

        $paymentResult = $paymentModel->getPaymentInfo($insert_id);
        echo view('buy/paymentResult', [
            'paymentResult' => $paymentResult[0],
        ]);      
    }
}
