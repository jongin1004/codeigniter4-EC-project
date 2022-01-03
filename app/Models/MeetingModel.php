<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetingModel extends Model
{
    protected $table      = 'meeting_post';
    protected $primaryKey = 'meeting_id';
    protected $allowedFields    = [
        'user_id',
        'category_id',
        'meeting_title',
        'meeting_description',
        'is_delete',
    ];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'date';
    // protected $createdField  = 'created_at';
}
