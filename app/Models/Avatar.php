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

    public function saveAvatar($id, $data)
    {
        // 해당 유저가 기존에 avatar를 가지고있는지 없는지를 판단
        $builder = $this->db->table('avatar');
        $has_file_user = $builder->where('user_id', $id)->get()->getResult();

        // 없으면, insert로 새로 추가
        if (empty($has_file_user)) {
            $insertResult = $builder->insert($data);
            if (!$insertResult) {
                return "Error: can`t insert";
            }
            return "success: success insert";
        }

        // 있으면 update로 수정
        $updateResult = $builder->update($data);
        if (!$updateResult) {
            return "Error: can`t update";
        }
        return "success: success update";            
    }
}
