<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CarDao.class.php";

//I messed something here up, so this service lost complete connection to the localhost
//it needs to be checked
class CarService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new VehicleDao);
    }

}
