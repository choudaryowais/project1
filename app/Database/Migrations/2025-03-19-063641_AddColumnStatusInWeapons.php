<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnStatusInWeapons extends Migration
{
    public function up()
    {
       $this->forge->addColumn('weapons', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Available', 'Issued','UnderMaintenance','Damaged','Lost','Decommissioned'],
                'default' => 'Available',
                'after'      =>'police_station_id',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('weapons', 'status');
    }
}
