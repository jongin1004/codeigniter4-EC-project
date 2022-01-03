<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',                
            ],
            'category_type' => [
                'type'       => 'ENUM',
                'constraint' => "'sale','meeting'",                
            ],
            'is_delete' => [
                'type'       => 'ENUM',
                'constraint' => "'y','n'",
                'default'    => 'n',
            ]
        ]);
        $this->forge->addPrimaryKey('category_id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
