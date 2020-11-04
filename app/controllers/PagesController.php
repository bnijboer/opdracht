<?php

namespace App\Controllers;

class PagesController
{
    public function home()
    {        
        authCheck();
        
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