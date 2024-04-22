<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/UserDao.class.php";


class UserService extends CarService
{
    public function __construct()
    {
        parent::__construct(new CustomerDao);
    }


    function getCustomerByFirstNameAndLastName($first_name, $last_name)
    {
        return $this->dao->getCustomerByFirstNameAndLastName($first_name, $last_name);
    }
}

