<?php
require_once __DIR__ . '/BaseDao.class.php';


class CarDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("cars");  
    }

    function getCarsWithManualTransmission(){
    return $this->query("SELECT *
    FROM vehicles
    WHERE transmission = 'manual'");
    }   
}
