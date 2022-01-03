<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReviews extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'review_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'buyer_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'seller_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,              
            ],
            'review_rating' => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'review_description' => [
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
        $this->forge->addPrimaryKey('review_id');
        $this->forge->addForeignKey('buyer_id', 'users', 'user_id');
        $this->forge->addForeignKey('seller_id', 'users', 'user_id');
        $this->forge->createTable('reviews');
    }

    public function down()
    {
        $this->forge->dropTable('reviews');
    }
}
