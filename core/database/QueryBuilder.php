<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class QueryBuilder
{
    protected $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function selectAll($table)
    {
        $sql = sprintf(
            'SELECT * FROM %s',
            $table
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function select($table, $data)
    {
        $key = implode(array_keys($data));
        
        $sql = sprintf(
            'SELECT * FROM %s WHERE %s',
            $table,
            $key . '=' . '"' . $data[$key] . '"'
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
            
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function insert($table, $data)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($data)),
            ':' . implode(', :', array_keys($data))
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function update($table, $data, $row)
    {
        $sql = sprintf(
            'UPDATE %s SET %s WHERE %s',
            $table,
            implode(', ', array_map(function ($key, $value) {
                return $key . '=' . $value;
            }, array_keys($data), $data)),
            $row
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function createUsersTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(250) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        try { 
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function createFileTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS file (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            boekjaar YEAR,
            week TINYINT(2),
            datum DATE,
            persnr SMALLINT(5),
            uren DECIMAL(4,2),
            uurcode VARCHAR(10)
        )";
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}