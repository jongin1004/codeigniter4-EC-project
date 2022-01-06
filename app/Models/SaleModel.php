<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table            = 'sale_post';
    protected $primaryKey       = 'sale_id';
    protected $allowedFields    = [
        'user_id',
        'category_id',
        'file_id',
        'sale_title',
        'sale_description',
        'sale_state',
        'sale_price',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
