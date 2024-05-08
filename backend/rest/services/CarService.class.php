<?php
require_once 'BaseService.class.php';
require_once __DIR__ . "/../dao/CarDao.class.php";

class CarService extends BaseService{

    public $car_dao;
    
    public function __construct(){
        parent::__construct(new CarDao);
    }

    public function getById($car_id) {
        return $this->dao->get_car_by_id($car_id);
    }

    public function edit_car($car) {
        $id = $car['id'];
        unset($car['id']);

        $this->car_dao->edit_car($id, $car);
    }
    
}
