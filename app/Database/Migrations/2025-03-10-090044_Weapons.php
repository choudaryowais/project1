<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Weapons extends Migration
{
    public function up()
    {
        $fields=[
            'id'=>[
                'type'=>'INT',
                'auto_increment'=>true,
                'constraint'=>'20',
                'null'=>false
            ],
            'name'=>[
                'type' => 'ENUM',
                'constraint' => ['SMG(AK-47)', 'G3', 'MP-5', 'Beretta', 'Glock','Revolver'],
                'null' => false
            ],
            'type'=>[
              'type' => 'ENUM',
                'constraint' => ['gun', 'pistol'],
                'null' => false
            ],
            'weaponno'=>[
                'type'=>'varchar',
                'constraint'=>'50',
                'null'=>false
            ],
            'police_station_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at'=>[
                'type'=>'datetime',
                'null'=>true
            ],
            'updated_at'=>[
                'type'=>'datetime',
                'null'=>true
            ],
        ];

        $this->forge->addfield($fields);
        $this->forge->addkey('id',true);
        $this->forge->addForeignKey('police_station_id', 'police_stations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createtable('weapons');
    }

    public function down()
    {
        $this->forge->droptable('weapons');

    }
}
