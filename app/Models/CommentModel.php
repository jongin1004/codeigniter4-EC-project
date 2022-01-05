<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table            = 'meeting_comment';
    protected $primaryKey       = 'comment_id';
    protected $allowedFields    = ['user_id', 'meeting_id', 'comment_description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getsCommentAndUser($id)
    {
        $build = $this->db->table('meeting_comment');
        $getData = $build->select(['comment_description', 'user_name', 'meeting_comment.created_at'])
                        ->join('users', 'users.user_id = meeting_comment.user_id', 'left')
                        ->where('meeting_comment.meeting_id', $id)
                        ->get()->getResultArray();

        return $getData;
    }

    public function getCommentAndUser($id)
    {
        $build = $this->db->table('meeting_comment');
        $comment = $build->select(['comment_description', 'user_name', 'meeting_comment.created_at'])
                        ->join('users', 'users.user_id = meeting_comment.user_id', 'left')
                        ->where('meeting_comment.comment_id', $id)
                        ->get()->getResultArray();

        return $comment;
    }
}
