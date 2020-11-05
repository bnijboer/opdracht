<?php

namespace App\Controllers;

use App\Core\App;

class FileController
{
    public function create()
    {
        authCheck();
        
        $db = App::get('database');
        
        if(! $data = $db->selectAll('file')) {
            header('Location: /');
            exit;
        }
        
        $file = fopen($_SERVER['DOCUMENT_ROOT'] . "\output\\output.csv", 'w') or die("Writing failed.");
        
        // captures column headers (except for 'id'), and capitalizes them
        $headers = array_map(function ($n) {
            return ucfirst($n);
        }, array_slice(array_keys($data[0]), 1));
        
        fputcsv($file, $headers, ';');
        
        foreach ($data as $row) {
            
            //removes id column
            array_shift($row);
            
            $row['datum'] = date('m/d/Y', strtotime($row['datum']));
            
            //trims off decimal zeroes, then converts decimal sepataror to comma
            $row['uren'] = str_replace('.', ',', floatval($row['uren']));
            
            fputcsv($file, $row, ';');
        }
        
        fclose($file);
        
        echo("Data successfully written to " . $_SERVER['DOCUMENT_ROOT'] . "\output\output.csv");
        header("refresh:5; url=/");
        exit;
    }
    
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
            
            header('Location: /file');
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
        
        header('Location: /');
        exit;
    }
    
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