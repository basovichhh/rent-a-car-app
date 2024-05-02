<?php
require_once __DIR__ . '/BaseDao.class.php';


class CarDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("cars");  
        //name of the table in DB is written with lower-case letter, so I wrote it like that in every class
    }

    function getCarsWithManualTransmission(){
    return $this->query("SELECT *
    FROM vehicles
    WHERE transmission = 'manual'");
    }   
}
