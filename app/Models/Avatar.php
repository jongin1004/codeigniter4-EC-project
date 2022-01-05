<?php

namespace App\Models;

use CodeIgniter\Model;

class Avatar extends Model
{
    protected $table            = 'avatar';
    protected $primaryKey       = 'avatar_id';
    protected $allowedFields    = ['user_id', 'avatar_title'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
