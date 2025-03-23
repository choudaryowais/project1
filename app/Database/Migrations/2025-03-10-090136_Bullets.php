<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bullets extends Migration
{
    public function up()
    {

        $data=[
            'id'=>[
                'type'=>'INT',
                'constraint'=>5,
                'unsigned'=>true,
                'auto_increment'=>true
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'20',
                'null'=>false,
            ],
            'Quantity'=>[
                'type'=>'INT',
                'constraint'=>10,
                'null'=>false,
            ],
            'police_station_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at'=>[
                'type'=>'DATETIME',
                'null'=>true,
            ],
            'updated_at'=>[
                'type'=>'DATETIME',
                'null'=>true,
            ],
        ];
    
        $this->forge->addfield($data);
        $this->forge->addkey('id',true);
        $this->forge->addForeignKey('police_station_id', 'police_stations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createtable('bullets');
    }

    public function down()
    {
        $this->forge->droptable('bullets');

    }
}
