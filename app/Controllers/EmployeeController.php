<?php

namespace App\Controllers;
use App\Models\EmployeesModel;

class EmployeeController extends BaseController
{
    public function employeeform()
    {
        $title="Employee Form";
        return view('employeeform', ['title'=>$title]);
    }

    public function SaveEmployeeForm()
    {
        if ($this->request->getMethod() == 'POST') {

            $data = [
                'name' => $this->request->getPost('name'),
                'cnic' => $this->request->getPost('cnic'),
                'beltNo' => $this->request->getPost('beltNo'),
                'police_station_id' => $this->request->getPost('police_station_id'),

            ];

            $EmployeeModel = new EmployeesModel();
            
            

            if ($EmployeeModel->save($data)) {
                session()->setFlashdata('success', 'Data Inserted Successfully');
                return redirect()->to(base_url('employeeform'));
            } else {
                session()->setFlashdata('error', 'Data Insertion Failed');
                return redirect()->to(base_url('employeeform'));
            }
        }
    }

    public function show(){
        $EmployeeModel = new EmployeesModel();
        $data['employees'] = $EmployeeModel->findAll();
        $data['title']="Employee List";
        return view('employeeDetail', $data);
    }

    public function search()
    {
        $request = service('request');
        $searchData = $request->getPost(); // Get DataTables request parameters
    
        $EmployeeModel = new EmployeesModel();
        $result = $EmployeeModel->searchEmployees($searchData);
    
        // Add the 'action' and 'insert_action' fields to each row
        $data = array_map(function($row) {
            // Generate buttons for actions (View, Edit, Delete)
            $row['action'] = '
                <a href="/employeeDetail/' . $row['id'] . '" class="btn btn-info">View</a>
                <a href="/employee/edit/' . $row['id'] . '" class="btn btn-warning">Edit</a>
                <a href="/employee/delete/' . $row['id'] . '" class="btn btn-danger">Delete</a>
            ';
            return $row;
        }, $result);
    
        return $this->response->setJSON($data);
    }


    
    public function simplesearch()
{
    $searchInput = $this->request->getPost('searchInput');
    $employeesModel = new EmployeesModel(); // Variable name is $employeesModel
        
    $employees = $employeesModel->like('name', $searchInput)
                               ->orLike('beltno', $searchInput)  // Ensure this matches the database field
                               ->orLike('cnic', $searchInput)
                               ->findAll();
        
    return $this->response->setJSON(['data' => $employees]);
}
}