<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMeetingComment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id' => [
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
            'meeting_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'comment_description' => [
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
        $this->forge->addPrimaryKey('comment_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('meeting_id', 'meeting_post', 'meeting_id');
        $this->forge->createTable('meeting_comment');
    }

    public function down()
    {
        $this->forge->dropTable('meeting_comment');
    }
}
