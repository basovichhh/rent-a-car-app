<?php
require_once __DIR__ . '/BaseDao.class.php';


class BookingDao extends BaseDao{

    public function __construct(){
        parent::__construct("bookings");  
    }

    public function get_all_bookings(){
        try {
            $query = "SELECT * FROM bookings";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Error retrieving bookings: " . $e->getMessage());
        }
    }

    public function add_booking($booking_data) {
        try {
            $query = "INSERT INTO bookings (user_id, car_id, location_id, date_of_booking, date_of_payment, paid) VALUES (:user_id, :car_id, :location_id, :date_of_booking, :date_of_payment, :paid)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute($booking_data);
            return $this->connection->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Error adding booking: " . $e->getMessage());
        }
    }
    


    function getPaidBookingsPerLocation($location_id)
    {
        return $this->query("SELECT *
        FROM bookings
        WHERE paid = 1 AND location_id = :location_id", [ "location_id" => $location_id]);
    } 

    function getUnpaidBookingsPerLocation($location_id)
    {
        return $this->query("SELECT *
        FROM bookings
        WHERE paid = 0 AND location_id = :location_id", [ "location_id" => $location_id]);
    }  
}
