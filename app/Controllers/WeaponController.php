<?php
namespace App\Controllers;
use App\Models\WeaponsModel;
use App\Models\EmployeesModel;
use App\Models\IssuedWeaponsModel;

class WeaponController extends BaseController
{
    //display weapon form
    public function weaponform()
    {
        $title="Weapon Form";
        return view('weaponform', ['title'=>$title]);
    }

    //display weapon form
    public function GetEmpInfo($weapon_id = null)
{
    $title = "Issue Weapon";

    // Fetch weapon details from the database using the weapon_id
    $WeaponModel = new WeaponsModel();
    $weaponDetails = $WeaponModel->find($weapon_id);

    // Get user_id from the session
    $user_id = session()->get('user_id');

    // Pass data to the view
    return view('WeaponIssueForm', [
        'title' => $title,
        'weapon_id' => $weapon_id,
        'weaponDetails' => $weaponDetails,
        'user_id' => $user_id
    ]);
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
        <a href="' . base_url('weapon-controller/get-emp-info/' . $row['id']) . '" class="btn btn-success">Issue</a>
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


    public function IssueWeaponForm()
{
    $title = "Issue Weapon";

    // Get employee_id and weapon_id from the query parameters
    $request = service('request');
    $employee_id = $request->getGet('employee_id');
    $weapon_id = $request->getGet('weapon_id');

    // Fetch employee details
    $EmployeeModel = new EmployeesModel();
    $employeeDetails = $EmployeeModel->find($employee_id);

    // Fetch weapon details
    $WeaponModel = new WeaponsModel();
    $weaponDetails = $WeaponModel->find($weapon_id);

    // Get user_id from the session
    $user_id = session()->get('user_id');

    // Pass data to the view
    return view('WeaponIssueForm2', [
        'title' => $title,
        'employeeDetails' => $employeeDetails,
        'weaponDetails' => $weaponDetails,
        'user_id' => $user_id
    ]);
}




    // Handle the form submission for issuing a weapon for issuing weapon form2
  
    public function IssuingWeapon()
    {
        if ($this->request->getMethod() == 'POST') {
            // Get form data
            $data = [
                'weapon_id' => $this->request->getPost('weapon_id'),
                'weapon_no' => $this->request->getPost('weapon_no'),
                'weapon_name'=>$this->request->getPost('weapon_name'),
                'employee_id' => $this->request->getPost('employee_id'),
                'employee_name' => $this->request->getPost('name'),
                'user_id' => $this->request->getPost('user_id'),
                'bullet_name' => $this->request->getPost('bullets_name'),
                'bullet_quantity' => $this->request->getPost('no_of_bullets'),
                'issue_date' => $this->request->getPost('issue_date'),
                'status' => 'Issued' // Set status to 'Issued' in issued_weapons table
            ];

            // Load the models
            $IssuedWeaponsModel = new IssuedWeaponsModel();
            $WeaponsModel = new WeaponsModel();

            // Start a database transaction (optional but recommended for data consistency)
            $db = \Config\Database::connect();
            $db->transStart();

            try {
                // Insert data into the issued_weapons table
                $IssuedWeaponsModel->insert($data);

                // Update the status of the weapon in the weapons table
                $WeaponsModel->update($data['weapon_id'], ['status' => 'issued']);

                // Commit the transaction
                $db->transComplete();

                // Redirect to a success page or display a success message
                session()->setFlashdata('success', 'Weapon issued successfully!');
                return redirect()->to(base_url('/WeaponController/issueweapon'));
            } catch (\Exception $e) {
                // Rollback the transaction in case of an error
                $db->transRollback();

                // Redirect to an error page or display an error message
                session()->setFlashdata('error', 'Failed to issue weapon: ' . $e->getMessage());
                return redirect()->to(base_url('weaponoptions'));
            }
        }
    }

   // In your controller
   public function getissuedWeapons()
   {
       $model = new IssuedWeaponsModel();

       
       // Get the user_id from session
       $userId = session()->get('user_id');
       
       // Only fetch weapons issued to this user
       $data['issuedWeapons'] = $model->where('user_id', $userId)->findAll();
       
       $data['title'] = "Stats";
       return view('issuedWeapons', $data);
   }

    

  
}

