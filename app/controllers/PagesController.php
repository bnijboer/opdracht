<?php

namespace App\Controllers;

class PagesController
{
    public function home()
    {        
        session_start();
        
        if(! $_SESSION['loggedIn']){
            header('Location: /login');
            exit;
        }
        
        return view('index');
    }
    
    public function login()
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }
}