<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoppingCartModel extends Model
{
    protected $table            = 'shopping_cart';
    protected $primaryKey       = 'cart_id';
    protected $allowedFields    = ['user_id', 'sale_id'];

    // insertする前に、当該商品が既にテーブルにあるかどうかを確認して保存
    public function saveCart($insertData)
    {
        $builder = $this->db->table('shopping_cart');
        $is_has = $builder->where('user_id', $insertData['user_id'])
                    ->where('sale_id', $insertData['sale_id'])
                    ->get()->getResult();

        if ($is_has) {
            return "この商品は既に保存されています。";
            
        }

        $insertResult = $builder->set('sale_id', $insertData['sale_id'])
                ->set('user_id', $insertData['user_id'])
                ->insert();
        
        return $insertResult;
    }

    public function getCartAndSaleInfo($user_id)
    {
        $builder = $this->db->table('shopping_cart');
        $getData = $builder->select(['sale_title', 'sale_price', 'sale_state', 'user_name'])
                        ->join('sale_post', 'sale_post.sale_id = shopping_cart.sale_id')
                        ->join('users', 'users.user_id = sale_post.user_id')
                        ->where('shopping_cart.user_id', $user_id)
                        ->get()->getResultArray();
        
        return $getData;
    }
}
