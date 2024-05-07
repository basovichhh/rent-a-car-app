<?php
require_once 'BaseService.class.php';
require_once __DIR__ . "/../dao/CarDao.class.php";

class CarService extends BaseService{

    private $car_dao;
    
    public function __construct(){
        parent::__construct(new CarDao);
    }
}
