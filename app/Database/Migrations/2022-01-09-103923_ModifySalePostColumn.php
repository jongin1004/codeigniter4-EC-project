<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifySalePostColumn extends Migration
{
    public function up()
    {
        $fields = [
            'is_saled' => [
                'type'       => 'ENUM',
                'constraint' => '"y","n"',
                'null'       => true
            ]
        ];

        $this->forge->addColumn('sale_post', $fields);
    }

    public function down()
    {
        //
    }
}
