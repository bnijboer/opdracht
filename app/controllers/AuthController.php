<?php

namespace App\Controllers;

use App\Core\App;

class AuthController
{
    public function register()
    {
        App::get('database')->insert('users', [
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
        
        return header('Location: /');
    }
    
    public function login()
    {
        $result = App::get('database')->select('users', [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ]);
        
        if($result){
            if (password_verify($_POST['password'], $result->password)) {

                session_start();
            
                $_SESSION['id'] = $result->id;
                $_SESSION['username'] = $result->username;
                $_SESSION['loggedIn'] = true;
                
                header('Location: /');
                exit;
                
            } else {
                die('Invalid credentials.');
            }
        } else {
            die("No user found with username '{$_POST['username']}'.");
        }
        
        header('Location: /login');
        exit;
    }
    
    public function logout()
    {
        session_start();
        session_destroy();
        
        return header('Location: /login');
    }
}