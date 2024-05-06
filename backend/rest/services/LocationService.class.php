<?php
require_once __DIR__ . "/BaseService.class.php";
require_once __DIR__ . "/../dao/LocationDao.class.php";


class LocationService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new LocationDao);
    }


    function getNumberOfBookingsPerLocation($location_id)
    {
        return $this->dao->getNumberOfBookingsPerLocation($location_id);
    }

}
