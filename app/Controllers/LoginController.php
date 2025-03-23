<?php

namespace App\Controllers;


class LoginController extends BaseController
{
    public function index()
    {
        $title="Login";
        // Render the login view
        return view('login',['title'=>$title]);
    }

    public function auth(){
        // Get the request object
        $request = service('request');

        // Get the user inputs
        $email = $request->getPost('email');
        $password = $request->getPost('password');

        // Check if the user exists
        $user = $this->userModel->where('email', $email)->first();

        if($user){
            // Verify the password
            if(password_verify($password, $user['password'])){
                // Set the user session
                $_SESSION['user'] = $user;
                return redirect()->to('/dashboard');
            }
        }

        // Redirect to the login page with an error message
        return redirect()->to('/login')->with('error', 'Invalid login details');
         

    }

    public function logout()
    {
        // Handle the logout logic
        unset($_SESSION['user']);
        header('Location: /login');
    }
}