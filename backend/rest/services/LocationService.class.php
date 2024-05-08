<?php
require_once __DIR__ . "/BaseService.class.php";
require_once __DIR__ . "/../dao/LocationDao.class.php";


class LocationService extends BaseService
{
    public $location_dao;


    public function __construct()
    {
        parent::__construct(new LocationDao);
    }

    public function getById($location_id) {
        return $this->dao->get_location_by_id($location_id);
    }

    public function edit_location($location) {
        $id = $location['id'];
        unset($location['id']);

        $this->location_dao->edit_location($id, $location);
    }
}
