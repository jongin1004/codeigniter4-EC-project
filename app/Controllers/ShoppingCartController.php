<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ShoppingCartController extends BaseController
{
    protected $cartModel;

    function __construct()
    {
        $this->cartModel = model('ShoppingCartModel');
    }

    public function index()
    {
        //
    }

    public function addItem($id = null)
    {
        // session / service 선언
        $session = session();
        $validation = service('validation');


        $insertData = [
            'user_id' => $session->get('user_id'),
            'sale_id' => $id,
        ];        

        // validation 검증
        $is_validate = $validation->run($insertData, 'shoppingCart');
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('sale/showDetail', [
                'errors' => $errors,
            ]);
        }
        
        $insertResult = $this->cartModel->saveCart($insertData);
        
        if (!($insertResult === true)) {
            echo "<script> alert('{$insertResult}');window.location.assign('".base_url('sale/'.$id)."');</script>";
            return;
        }

        echo "<script> alert('成功');window.location.assign('".base_url('sale/'.$id)."');</script>";
        return;
        // return redirect()->to(base_url('sale/'.$id));
    }
}
