<?php
require_once __DIR__ . "/BaseService.class.php";
require_once __DIR__ . "/../dao/UserDao.class.php";


class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new UserDao);
    }


    function getCustomerByFirstNameAndLastName($first_name, $last_name)
    {
        return $this->dao->getCustomerByFirstNameAndLastName($first_name, $last_name);
    }
}

