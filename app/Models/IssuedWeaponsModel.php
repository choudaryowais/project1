<?php

namespace App\Models;

use CodeIgniter\Model;

class IssuedWeaponsModel extends Model
{
    protected $table      = 'issued_weapons'; // Name of the database table
    protected $primaryKey = 'id'; // Primary key of the table

    protected $useAutoIncrement = true; // Whether to use auto-increment for the primary key

    protected $returnType     = 'array'; // Type of data returned by queries
    protected $useSoftDeletes = false; // Whether to use soft deletes

    protected $allowedFields = [
        'weapon_id', 
        'weapon_name', 
        'employee_id', 
        'bullet_name', 
        'bullet_quantity', 
        'user_id', 
        'issue_date', 
        'return_date', 
        'status'
    ]; // Fields that are allowed to be mass-assigned

    protected $useTimestamps = false; // Whether to use timestamps (created_at, updated_at)
}