<?php
require_once 'BaseService.class.php';
require_once __DIR__ . "/../dao/CarDao.class.php";

class CarService extends BaseService{

    private $car_dao;
    
    public function __construct(){
        $this->car_dao = new CarDao();
    }

    public function add_car($car){
        return $this->car_dao->add_car($car);
    }
 
}
