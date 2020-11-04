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
    
    public function select($table, $params)
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE %s',
            $table,            
            'username="' . $params['username'] . '"'
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            
            return $statement->fetch(PDO::FETCH_OBJ);
            
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function insert($table, $params)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function createUsersTable()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) UNIQUE NOT NULL,
                password VARCHAR(250) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
          
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function createFileTable()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS file (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                boekjaar YEAR,
                week TINYINT(2),
                datum DATE,
                persnr SMALLINT(5),
                uren DECIMAL(4,2),
                uurcode VARCHAR(10)
            )";
          
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}