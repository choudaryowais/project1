<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AuthController extends BaseController
{
    public function login()
{
    // Check if the request method is POST
    if ($this->request->getMethod() == 'POST') {
        // Get username and password from the form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        

        // Load the UsersModel
        $userModel = new UsersModel();
        
        // Find the user by username (assuming 'name' is the column in the users table)
        $user_info = $userModel->where('name', $username)->first();
       
        
        // Check if the user exists and the password matches
        if ($user_info && $user_info['password'] === $password) {
            // Authentication successful
            
            // Check if the user has 'admin' role
            if ($user_info['role'] === 'admin') {
                // Set user session for admin role
                session()->set('user_id', $user_info['id']);
                session()->set('username', $user_info['name']);
                session()->set('role', $user_info['role']);  // Store the user's role

                // Redirect to the admin dashboard (or any other page you want to restrict to admins)
                return redirect()->to('/dashboard');
            } else {
                // User is not admin, redirect to user dashboard or other pages
                session()->set('user_id', $user_info['id']);
                session()->set('username', $user_info['name']);
                session()->set('role', $user_info['role']); // Store the role for non-admins too
                session()->set('police_station_id', $user_info['police_station_id']);  // Store the user's role

                return redirect()->to('/dashboard');
            }
        } else {
           
            // Authentication failed, redirect back to the login page
            return redirect()->to(base_url('/login'))->with('error', 'Invalid username or password');
        }
    }

    // If it's not a POST request, show the login form
    return view('login'); // Replace with your view file
}




    public function logout()
    {
        // Destroy the session and log the user out
        session()->destroy();
        $title="login";
        return view('index'); // Redirect to the login page
    }
}