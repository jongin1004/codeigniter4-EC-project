<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddChats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'chat_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'to_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'from_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'chat_message' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true                
            ],
            'is_delete' => [
                'type'       => 'ENUM',
                'constraint' => "'y','n'",
                'default'    => 'n',
            ]
        ]);
        $this->forge->addPrimaryKey('chat_id');
        $this->forge->addForeignKey('to_id', 'users', 'user_id');
        $this->forge->addForeignKey('from_id', 'users', 'user_id');
        $this->forge->createTable('chats');
    }

    public function down()
    {
        $this->forge->dropTable('chats');
    }
}
