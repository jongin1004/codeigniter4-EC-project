<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoppingCartModel extends Model
{
    protected $table            = 'shopping_cart';
    protected $primaryKey       = 'cart_id';
    protected $allowedFields    = ['user_id', 'sale_id'];

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
}
