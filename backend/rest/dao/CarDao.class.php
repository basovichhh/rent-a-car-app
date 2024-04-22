<?php

require_once __DIR__ . '/BaseDao.class.php';

class CarDao extends BaseDao {
    public function __construct(){
        parent::__construct('cars');
    }

    public function add_car($car){

        // todo implement add logic
        return $car;
    }
}