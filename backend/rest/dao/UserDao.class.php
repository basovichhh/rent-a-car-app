<?php
require_once __DIR__ . '/BaseDao.class.php';


class UserDao extends BaseDao{

    public function __construct(){
        parent::__construct("users");
    }

    public function get_all_users(){
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Error retrieving users: " . $e->getMessage());
        }
    }

    public function delete_user_by_id() {
        $this->delete('users');
    }

    
    function getCustomerByFirstNameAndLastName($first_name, $last_name){
        return $this->query_unique("SELECT * FROM users WHERE  = :first_name AND last_name = :last_name", ["first_name" => $first_name, "last_name" => $last_name]);
    }
}
