<?php
require_once __DIR__ . '/BaseDao.class.php';


class UserDao extends BaseDao
{
    public function __construct(){
        parent::__construct("users");
    }

    
    function getCustomerByFirstNameAndLastName($first_name, $last_name){
         return $this->query_unique("SELECT * FROM users WHERE  = :first_name AND last_name = :last_name", ["first_name" => $first_name, "last_name" => $last_name]);
     }
}
