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

}
