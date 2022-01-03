<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSalePost extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sale_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned'   => true,
            ],
            'file_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned'   => true,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned'   => true,
            ],
            'sale_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',                
            ],
            'sale_description' => [
                'type' => 'TEXT',
            ],
            'sale_state' => [
                'type'       => 'ENUM',
                'constraint' => "'b','m','w'",
                'default'    => 'm',
            ],
            'sale_price' => [
                'type' => 'VARCHAR',
                'constraint' => '20',                
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'is_delete' => [
                'type'       => 'ENUM',
                'constraint' => "'y','n'",
                'default'    => 'n',
            ]
        ]);

        $this->forge->addPrimaryKey('sale_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('category_id', 'categories', 'category_id');
        $this->forge->addForeignKey('file_id', 'files', 'file_id');
        $this->forge->createTable('sale_post');
    }

    public function down()
    {
        $this->forge->dropTable('sale_post');
    }
}
