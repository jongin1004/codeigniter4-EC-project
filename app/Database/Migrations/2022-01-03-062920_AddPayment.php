<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPayment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id' => [
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
            'address_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'payment_amount' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,                           
            ],
            'created_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true                
            ],
            'updated_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true                
            ],
            'is_delete' => [
                'type'           => 'ENUM',
                'constraint'     => "'y','n'",
                'default'        => 'n',
            ]
        ]);
        $this->forge->addPrimaryKey('payment_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('sale_id', 'sale_post', 'sale_id');
        $this->forge->addForeignKey('address_id', 'address', 'address_id');
        $this->forge->createTable('payment');
    }

    public function down()
    {
        $this->forge->dropTable('payment');
    }
}
