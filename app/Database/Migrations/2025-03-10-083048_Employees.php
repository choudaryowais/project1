<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'constraint' => 11,
                'null' => false
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'rank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'beltno' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'cnic' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => false
            ],
            'phoneno' => [
                'type' => 'BIGINT',
                'constraint' => 50,
                'null' => false
            ],
            'police_station_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('police_station_id', 'police_stations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}