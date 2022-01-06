<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = [
        'user_name',
        'user_email',
        'user_password'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserAndAvatar($id)
    {
        $builder = $this->db->table('users');
        $getUser = $builder->select('*')                
                ->join('avatar', 'avatar.user_id = users.user_id', 'left')
                ->where('users.user_id', $id)
                ->get()->getResultArray();

        return $getUser;
    }
}
