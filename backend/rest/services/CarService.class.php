<?php
require_once __DIR__ . "/BaseService.class.php";
require_once __DIR__ . "/../dao/CarDao.class.php";

class CarService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new CarDao);
    }

}
