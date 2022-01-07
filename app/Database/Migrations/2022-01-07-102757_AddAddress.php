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
            'address' => [
                'type'           => 'VARCHAR',
                'constraint'     => 150,                
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
    }

    public function down()
    {
        //
    }
}
