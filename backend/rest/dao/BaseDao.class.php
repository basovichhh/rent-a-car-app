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

    protected function query($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    protected function query_unique($query, $params){
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

    public function add($entity) {
        $query = "INSERT INTO " . $this->table_name . " (" ;
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

        $stmt = $this->connection->prepare($query);
        $stmt->execute($entity); // sql injection prevention
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

    protected function execute($query, $params){
        try {
            $prepared_statement = $this->connection->prepare($query);
            
            if ($params) {
                foreach ($params as $key => $param) {
                    $prepared_statement->bindValue($key, $param);
                }
            }
            
            $prepared_statement->execute();
            
            // Optionally, you can return the number of affected rows
            return $prepared_statement->rowCount();
        } catch (PDOException $e) {
            // Handle the exception (e.g., log or display the error message)
            echo "Error: " . $e->getMessage();
            // You might want to throw the exception again to propagate it to the caller
            throw $e;
        }
    }
    
}