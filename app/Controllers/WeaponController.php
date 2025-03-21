<?php
namespace App\Controllers;
use App\Models\WeaponsModel;

class WeaponController extends BaseController
{
    //display weapon form
    public function weaponform()
    {
        $title="Weapon Form";
        return view('weaponform', ['title'=>$title]);
    }
//insert weapon data from form
    public function SaveWeaponForm()
    {
        if ($this->request->getMethod() == 'POST') {

            $data = [
                'name' => $this->request->getPost('weapon_name'),
                'type' => $this->request->getPost('weapon_type'),
                'weaponno' => $this->request->getPost('weapon_no'),
                'police_station_id' => $this->request->getPost('police_station_id'),
            ];

        

            $WeaponModel = new WeaponsModel();
            
            

            if ($WeaponModel->save($data)) {
                session()->setFlashdata('success', 'Data Inserted Successfully');
                return redirect()->to(base_url('weaponform'));
            } else {
                session()->setFlashdata('error', 'Data Insertion Failed');
                return redirect()->to(base_url('weaponform'));
            }
        }
    }
// show all weapons
    public function show(){
        $WeaponModel = new WeaponsModel();
        $data['weapons'] = $WeaponModel->findAll();
        $data['title']="Weapon List";
        session()->set('position','view');
        return view('weaponDetail', $data);
    }
//issue weapon
    public function issueweapon(){
        $WeaponModel = new WeaponsModel();
        $data['weapons'] = $WeaponModel->findAll();
        $data['title']="Weapon List";
        session()->set('position','issue');

        return view('weaponDetail', $data);
    }

//server side search
    public function search()
{
    
    $request = service('request');
    $searchData = $request->getPost(); // Get DataTables request parameters

    // Get user's role and police_station_id from session
    $userRole = session()->get('role');
    $policeStationId = session()->get('police_station_id');

    $WeaponModel = new WeaponsModel();
    $result = $WeaponModel->searchWeapons($searchData, $userRole, $policeStationId);

    // Add the 'action' and 'insert_action' fields to each row
    $data = array_map(function($row) {
        // Generate buttons for actions (View, Edit, Delete)
        $row['action'] = '
            <a href="/weaponDetail/' . $row['id'] . '" class="btn btn-info">View</a>
            <a href="/weapon/edit/' . $row['id'] . '" class="btn btn-warning">Edit</a>
            <a href="/weapon/delete/' . $row['id'] . '" class="btn btn-danger">Delete</a>
        ';

        // Add a new button for insert_action (e.g., "Insert")
        $row['insert_action'] = '
            <a href="/weapon/delete/' . $row['id'] . '" class="btn btn-success">Issue</a>
        ';

        return $row;
    }, $result['data']);

    // Prepare the response for DataTables
    $response = [
        "draw" => isset($searchData['draw']) ? intval($searchData['draw']) : 1,
        "recordsTotal" => $WeaponModel->countAll(), // Total records without filtering
        "recordsFiltered" => $result['filteredCount'], // Total records after filtering
        "data" => $data // Data to display
    ];

    return $this->response->setJSON($response);
}

//display weapon options
    public function weaponoptions()
    {
        $title="Weapon Options";
        return view('weaponoptions', ['title'=>$title]);
    }

    
}