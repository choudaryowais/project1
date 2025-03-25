<?php namespace App\Models; 
use CodeIgniter\Model;

class UsersModel extends Model{

    protected $table='users';
    protected $DbGroup='default';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'police_station_id'];    protected $useTimestamps=true;
    protected $validatiobRules=[];
    protected $validationmessages=[];


}