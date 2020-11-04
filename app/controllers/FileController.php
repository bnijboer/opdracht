<?php

namespace App\Controllers;

use App\Core\App;

class FileController
{
    public function store()
    {
        $csv = array_map(function ($n) {
            return explode(';', preg_replace('/\s*/m', '', $n));
        }, file($_FILES['csvfile']['tmp_name']));
        
        var_dump($csv);
    }
}