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
        authCheck();
        
        $db = App::get('database');
        
        $db->update(
            'file',
            [
                'boekjaar' => $_POST['boekjaar'],
                'week' => $_POST['week'],
                'datum' => "'" . date('Y-m-d', strtotime($_POST['datum'])) . "'",
                'persnr' => $_POST['persnr'],
                'uren' => $_POST['uren'],
                'uurcode' =>  "'" . $_POST['uurcode'] . "'",
            ],
            "id={$_POST['id']}"
        );
        
        header('Location: /file');
        exit;
    }
}