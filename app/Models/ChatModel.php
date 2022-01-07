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

    public function getChats($to_id, $from_id)
    {
        // $builder = $this->db->table('chats');
        $sql = "SELECT * FROM chats WHERE (to_id = ? AND from_id = ?) OR (to_id = ? AND from_id = ?)";        
        $result = $this->db->query($sql, [$to_id, $from_id, $from_id, $to_id]);
        return $result->getResultArray();
    }

}
