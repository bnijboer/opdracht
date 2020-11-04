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
}