<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table            = 'chats';
    protected $primaryKey       = 'chat_id';
    protected $allowedFields    = [
        'to_id',
        'from_id',
        'chat_message',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // chating messages는 보내는사람 받는사람 모두의 메세지를 가져와야함
    public function getChats($to_id, $from_id)
    {        
        $sql = "SELECT from_id, to_id, user_name, chat_message, avatar_title, chats.created_at FROM chats ";
        $sql .= "LEFT JOIN avatar ON avatar.user_id = chats.from_id ";
        $sql .= "JOIN users ON users.user_id = chats.from_id ";
        $sql .= "WHERE (to_id = ? AND from_id = ?) OR (to_id = ? AND from_id = ?) ";
        $sql .= "ORDER BY chats.created_at ASC";
        $result = $this->db->query($sql, [$to_id, $from_id, $from_id, $to_id]);
        return $result->getResultArray();
    }

    public function getChat($id)
    {        
        $sql = "SELECT from_id, to_id, user_name, chat_message, avatar_title, chats.created_at FROM chats ";
        $sql .= "LEFT JOIN avatar ON avatar.user_id = chats.from_id ";
        $sql .= "JOIN users ON users.user_id = chats.from_id ";
        $sql .= "WHERE chats.chat_id = ? ";        
        $result = $this->db->query($sql, $id);
        return $result->getResultArray();
    }

    public function getChatTarget($from_id)
    {
        $builder = $this->db->table('chats');
        $chat_target = $builder->distinct('to_id')
                ->select(['to_id', 'user_name'])
                ->join('users', 'users.user_id = chats.to_id')
                ->where('from_id', $from_id)
                ->get()->getResultArray();

        return $chat_target;
    }
}