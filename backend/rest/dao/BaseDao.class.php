<?php

require_once __DIR__ . '/../config.php';

class BaseDao{
    protected $connection;
    private $table_name;

    public function __construct($table_name){
        $this->table_name = $table_name;
        try{
            $this->connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PASSWORD, 
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }catch(PDOException $e){
            throw $e;
        }
    }

    function query($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    protected function query_unique($query, $params)
    {
        $results = $this->query($query, $params);
        return reset($results);
    }

    function get_all() {
        $stmt = $this->query("SELECT * FROM " . $this->table_name);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getById($id) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE id = :id", ["id" => $id]);
    }

    public function insert($table, $entity) {
        $query = "INSERT INTO {$table} (";
        foreach ($entity as $column => $value) {
        $query .= $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
        $query .= ":" . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";

        $statement = $this->connection->prepare($query);
        $statement->execute($entity); // SQL injection prevention
        $entity['id'] = $this->connection->lastInsertId();
        return $entity;
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM " . $this->table_name . " WHERE id=:id");
        $stmt->bindParam(':id', $id); // SQL injection prevention
        $stmt->execute();
    }

    public function update($id, $entity, $id_column = "id") {
        $query = "UPDATE " . $this->table_name . " SET ";
        foreach ($entity as $column => $value) {
            $query .= $column . "= :" . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE $id_column = :id";

        $stmt = $this->connection->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }

//     protected function execute($query, $params){
//     $prepared_statement = $this->connection->prepare($query);
//     if ($params) {
//       foreach ($params as $key => $param) {
//         $prepared_statement->bindValue($key, $param);
//       }
//     }
//     $prepared_statement->execute();
//     return $prepared_statement;
//   }
}