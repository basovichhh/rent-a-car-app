<?php
require_once __DIR__ . '/BaseDao.class.php';


class CustomerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("users");
    }


    // custom function, which is not present in BaseDao, that will return all information of one customer based on its name and lastname
    // query_unique will return only 1 result if multiple are present, but query will return all
    function getCustomerByFirstNameAndLastName($first_name, $last_name)
    {
        return $this->query_unique("SELECT * FROM users WHERE  = :first_name AND last_name = :last_name", ["first_name" => $first_name, "last_name" => $last_name]);
    }
}
