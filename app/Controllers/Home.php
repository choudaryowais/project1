<?php

namespace App\Controllers;
use App\Models\EmployeesModel;

class Home extends BaseController
{
    public function index()
    {

        return view('index');
        // $empModel=new EmployeesModel();

        //to insert data
//==============================================
    // $data=[
    //     'name'=>'mobeen',
    //     'rank'=>'Constabele',
    //     'beltno'=>'1001',
    //     'cnic'=>'123456709',
    //     'phoneno'=>'123456709'
    // ];

    // $user= $empModel->insert($data);

    //     var_dump($user);
//==================================================
       //to select specific data

    //    $user=$empModel->find(1);
    //    var_dump($user);

//==================================================
    //to select all data
    // $user=$empModel->findAll();
    // var_dump($user);

//==================================================
    //to update data
    // $user=$empModel->find(1);
    // $user['name']='mobeen khan';
    // $empModel->save($user);
    // var_dump($user);

//==================================================
    //to delete data
    // $user=$empModel->delete(1);
    // var_dump($user);

//==================================================

    }

    public function login()
    {
        
        if ($this->request->getMethod() == 'post') {
            // Handle POST request (form submission)
          
        $data = [
            'username' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        var_dump($data);
    }

        echo  view('login');
    }
    

   


   
}

?>