<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table            = 'address';
    protected $primaryKey       = 'address_id';
    protected $allowedFields    = [
        'user_id',
        'fullAddress',
        'zipNo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
