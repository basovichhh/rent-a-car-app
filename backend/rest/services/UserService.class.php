<?php
require_once __DIR__ . "/BaseService.class.php";
require_once __DIR__ . "/../dao/UserDao.class.php";


class UserService extends BaseService{

    public $user_dao;
    public function __construct()
    {
        parent::__construct(new UserDao);
        $this->user_dao = $this->dao;
    }

    public function get_all_users(){
        return $this->user_dao->get_all_users();
    }

    public function getById($userId) {
        return $this->dao->get_user_By_id($userId);
    }


    // function getCustomerByFirstNameAndLastName($first_name, $last_name)
    // {
    //     return $this->dao->getCustomerByFirstNameAndLastName($first_name, $last_name);
    // }
}

