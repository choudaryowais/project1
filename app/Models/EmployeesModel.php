<?php 
namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'rank', 'beltno', 'cnic', 'phoneno', 'police_station_id'];
    protected $useTimestamps = true;
    protected $validationRules = [];
    protected $validationMessages = [];
}