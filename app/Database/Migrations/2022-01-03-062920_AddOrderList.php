<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderList extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_id' => [
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
            'sale_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
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
        $this->forge->addPrimaryKey('order_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('sale_id', 'sale_post', 'sale_id');
        $this->forge->createTable('order_list');
    }

    public function down()
    {
        $this->forge->dropTable('order_list');
    }
}
