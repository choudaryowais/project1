<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Updateissuedweaponform extends Migration
{
    public function up()
    {
        $fields = [
            'weapon_no' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'weapon_id'
            ],
            'employee_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'employee_id'
            ]
        ];

        $this->forge->addColumn('issued_weapons', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('issued_weapons', ['weapon_no', 'employee_name']);
    }
}
