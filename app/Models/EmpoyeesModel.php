<?php

namespace App\Models;


class EmployeesModel extends Model
{
    // Table name
    protected $table = 'employees';

    // Primary key
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    // Fillable fields
    protected $fillable = [
        'name',
        'email',
        'position',
        'salary'
    ];
}
?>