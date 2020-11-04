<?php

namespace App\Controllers;

use App\Core\App;

class FileController
{
    public function store()
    {
        authCheck();
        
        $csv = array_map(function ($n) {
            // removes new lines
            $row = explode(';', preg_replace('/\s*/m', '', $n));
            
            // converts to SQL format
            $row[2] = date('Y-m-d', strtotime($row[2]));
            $row[4] = str_replace(',', '.', $row[4]);
            
            return $row;
            
        }, file($_FILES['csvfile']['tmp_name']));
        
        //removes data type headers
        array_shift($csv);
        
        try {
            $db = App::get('database');
            $db->createFileTable();
            
            array_map(function ($n) use ($db){
                $db->insert('file', [
                    'boekjaar' => $n[0],
                    'week' => $n[1],
                    'datum' => $n[2],
                    'persnr' => $n[3],
                    'uren' => $n[4],
                    'uurcode' => $n[5]
                ]);
            }, $csv);
            
            header("Location: /file");
            exit;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function show()
    {        
        authCheck();
        
        $db = App::get('database');
        
        if($data = $db->selectAll('file')) {
            return view('file', compact('data'));
        }
        
        return view('file');
        
    }
}