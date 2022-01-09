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
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // public function getMore()
    // {
    //     $build = $this->db->table('meeting_post');
    //     $build->
    // }

    // public function getPostAndComment($id)
    // {
    //     $build = $this->db->table('meeting_post');
    //     $getData = $build->select('*')
    //                     ->join('meeting_comment', 'meeting_comment.meeting_id = meeting_post.meeting_id', 'left')
    //                     ->where('meeting_post.meeting_id', $id)
    //                     ->get()->getResultArray();

    //     return $getData;
    // }
}
