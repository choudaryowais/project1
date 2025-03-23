<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IssuedWeapons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'weapon_id' => [
                'type'=>'INT',
              
                'constraint'=>'20',
                'null'=>false
                
            ],
           'weapon_name' =>[
                'type'=>'VARCHAR',
                'constraint'=>'100',
                'null'=>false
           ],
            'employee_id' => [
               'type' => 'INT',
              
                'constraint' => 11,
                'null' => false
                
            ],
            'bullet_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
           
            'bullet_quantity' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => false
            ],
            'user_id' => [
                'type' => 'INT',
               
                'constraint' => 20,
                'null' => false
            ],
            'issue_date' => [
                'type' => 'DATETIME',
                'defaultExpression' => 'CURRENT_TIMESTAMP',      
                  ],

            'return_date' => [
                'type' => 'DATETIME',
                 'null' => true
                ],
            'status'=>[
                 'type'=> 'VARCHAR',
                 'constraint' => 100,
                'null' => false
                ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('weapon_id', 'weapons', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('issued_weapons');
    }

    public function down()
    {
        $this->forge->dropTable('issued_weapons');
    }
}