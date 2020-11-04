<?php

namespace App\Controllers;

use App\Core\App;

class RowController
{
    public function edit()
    {
        authCheck();
        
        $db = App::get('database');
        
        $row = $db->select('file', [
            'id' => $_POST['rowId']
        ]);
        
        return view('edit', compact('row'));
    }
    
    public function update()
    {
        dd($_POST);
    }
}