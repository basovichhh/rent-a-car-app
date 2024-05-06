<?php
require_once __DIR__ . '/BaseDao.class.php';


class LocationDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("locations");
    }


    function getNumberOfBookingsPerLocation($location_id){
        return $this->query_unique("SELECT COUNT(b.id) AS number_of_bookings_per_location
        FROM bookings b
        JOIN locations l ON b.location_id = l.id
        xWHERE l.id = :l.id", ["id" => $location_id]); 
     }
}

