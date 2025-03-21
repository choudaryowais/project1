<?php

namespace App\Controllers;
use App\Models\BulletsModel;

class BulletsController extends BaseController
{

    // to insert bullets
    public function bulletForm()
    {
        $title="Bullet Form";
        return view('bulletsform',['title'=>$title]);
    }

    public function insert()
    {
        $flag=0;

        if ($this->request->getMethod() == 'POST') {

            $data = [
                'name' => $this->request->getPost('name'),
                'Quantity' => $this->request->getPost('quantity'),
                'police_station_id' => $this->request->getPost('police_station_id'),
            ];

           
            $BulletsModel = new BulletsModel();

            $bulletdetail=$BulletsModel->findall();

            foreach($bulletdetail as $value)
            {
                if($data['name']==$value['name'] && $data['police_station_id']==$value['police_station_id'])
                {
                    echo "Record of this Bullet is alreay inserted";
                    

                    //$BulletsModel->update($value['id'],['Quantity'=>$data['Quantity']+'Quantity']);
                    session()->setFlashdata('error', 'You Can Not Enter Bullet Twice');
                    return redirect()->to(base_url('bulletform'));
                    $flag=1;
                }
            }
            //var_dump($bulletdetail["name"]);
            

            if($flag==0)
            {
              $BulletsModel->insert($data);
                session()->setFlashdata('success', 'Data Updated Successfully');
                return redirect()->to(base_url('bulletform'));
            }
        } else {
                session()->setFlashdata('error', 'Data Insertion Failed');
                return redirect()->to(base_url('bulletform'));
            }
            
        }
    

    //to view bullets
    public function viewBullets()
    {
        $title="Bullet Detail";
        $BulletsModel = new BulletsModel();
        $data['bullets'] = $BulletsModel->findAll();
        $data['title'] = $title;
        
        return view('bulletDetail',$data);
        
    }

//server side search
public function search()
{
    $request = service('request');
    $searchData = $request->getPost(); // Get DataTables request parameters

    // Get user's role and police_station_id from session
    $userRole = session()->get('role');
    $policeStationId = session()->get('police_station_id');

    $BulletsModel = new BulletsModel();
    $result = $BulletsModel->searchBullets($searchData, $userRole, $policeStationId);

    // Add the 'action' and 'status' fields to each row
    $data = array_map(function($row) {
        // Generate buttons for actions (Edit, Delete)
        $row['action'] = '
            <a href="/BulletsController/delete/' . $row['id'] . '" class="btn btn-success">Edit</a>
        ';

        // Ensure the status is fetched from the database
        $row['status'] = $row['status']; // This should come from the database

        return $row;
    }, $result['data']);

    // Prepare the response for DataTables
    $response = [
        "draw" => isset($searchData['draw']) ? intval($searchData['draw']) : 1,
        "recordsTotal" => $BulletsModel->countAll(), // Total records without filtering
        "recordsFiltered" => $result['filteredCount'], // Total records after filtering
        "data" => $data // Data to display
    ];

    return $this->response->setJSON($response);
}

        
}
