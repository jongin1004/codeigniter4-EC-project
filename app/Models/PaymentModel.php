<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payment';
    protected $primaryKey       = 'payment_id';
    protected $allowedFields    = [
        'user_id',
        'sale_id',
        'address_id',
        'payment_amount',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPaymentInfo($payment_id)
    {
        $builder = $this->db->table('payment');
        $getData = $builder->select(['sale_title', 'sale_price', 'fullAddress'])
                        ->join('sale_post', 'sale_post.sale_id = payment.sale_id')
                        ->join('address', 'address.address_id = payment.address_id')
                        ->where('payment.payment_id', $payment_id)
                        ->get()->getResultArray();

        return $getData;
    }
}
