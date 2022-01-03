<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'file_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'file_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],    
        ]);
        $this->forge->addPrimaryKey('file_id');
        $this->forge->createTable('files');
    }

    public function down()
    {
        $this->forge->dropTable('files');
    }
}
