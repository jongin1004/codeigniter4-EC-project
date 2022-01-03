<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMeetingPost extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'meeting_id' => [
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
            'category_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'meeting_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'meeting_description' => [
                'type' => 'TEXT',
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
        $this->forge->addPrimaryKey('meeting_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('category_id', 'categories', 'category_id');
        $this->forge->createTable('meeting_post');
    }

    public function down()
    {
        $this->forge->dropTable('meeting_post');
    }
}
