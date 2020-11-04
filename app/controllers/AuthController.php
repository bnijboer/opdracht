<?php

namespace App\Controllers;

use App\Core\App;

class AuthController
{
    public function register()
    {
        $db = App::get('database');
        
        $db->createUsersTable();
        
        try {
            $db->insert('users', [
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
        session_start();
        
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['loggedIn'] = true;
        
        header('Location: /');
        exit;
    }
    
    public function login()
    {
        $result = App::get('database')->select('users', [
            'username' => $_POST['username']
        ]);
        
        if($result){
            if (password_verify($_POST['password'], $result->password)) {

                session_start();
            
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