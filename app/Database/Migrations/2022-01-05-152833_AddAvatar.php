<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAvatar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'avatar_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,                
            ],
            'avatar_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],    
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],    
        ]);
        $this->forge->addPrimaryKey('avatar_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->createTable('avatar');
    }

    public function down()
    {
        $this->forge->dropTable('avatar');
    }
}
