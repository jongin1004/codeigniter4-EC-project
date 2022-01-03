<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShoppingCart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cart_id' => [
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
        $this->forge->addPrimaryKey('cart_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('sale_id', 'sale_post', 'sale_id');
        $this->forge->createTable('shopping_cart');
    }

    public function down()
    {
        $this->forge->dropTable('shopping_cart');
    }
}
