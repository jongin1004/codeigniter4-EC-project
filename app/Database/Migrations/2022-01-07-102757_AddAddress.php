<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAddress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'address_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'fullAddress' => [
                'type'           => 'VARCHAR',
                'constraint'     => 150,                
            ],
            'zipNo' => [
                'type'           => 'VARCHAR',
                'constraint'     => 10,                
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,                
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,                
            ]            
        ]);
        $this->forge->addPrimaryKey('address_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');        
        $this->forge->createTable('address');
    }

    public function down()
    {
        $this->forge->dropTable('address');
    }
}
