<?php
namespace App\Models;
use CodeIgniter\Model;

class WeaponsModel extends Model
{
    protected $table = 'weapons';
    protected $primaryKey = 'id';
    protected $DBGroup = 'default';
    protected $allowedFields = ['name', 'type', 'weaponno','police_station_id','status'];
    protected $useTimestamps = true;
    protected $validationRules = [];
    protected $validationMessages = [];


    
    public function searchWeapons($searchData, $userRole, $policeStationId)
    {
        $builder = $this->db->table($this->table);
    
        // Total records count (without filtering)
        $totalRecords = $this->countAll();
    
        // Apply role-based filtering
        if ($userRole !== 'admin') {
            $builder->where('police_station_id', $policeStationId); // Filter by police_station_id for non-admin users
        }
    
        // Apply search filter
        if (!empty($searchData['search']['value'])) {
            $search = $searchData['search']['value'];
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('type', $search)
                    ->orLike('weaponno', $search)
                    ->groupEnd();
        }
    
        // Get filtered records count
        $filteredRecords = $builder->countAllResults(false);
    
        // Apply ordering
        if (!empty($searchData['order'])) {
            $orderByColumn = $searchData['order'][0]['column'];
            $orderByDirection = $searchData['order'][0]['dir'];
            $columnName = $searchData['columns'][$orderByColumn]['data']; // Use 'data' property
            $builder->orderBy($columnName, $orderByDirection);
        }
    
        // Apply pagination
        $builder->limit($searchData['length'], $searchData['start']);
    
        // Fetch data (only the fields that exist in the database)
        $data = $builder->get()->getResultArray();
    
        return [
            'filteredCount' => $filteredRecords,
            'data' => $data
        ];
    }
}