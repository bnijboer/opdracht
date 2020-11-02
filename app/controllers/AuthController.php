<?php

namespace App\Controllers;

use App\Core\App;

class AuthController
{
    public function register()
    {
        App::get('database')->insert('users', [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ]);
        
        header('Location: /');
    }
}