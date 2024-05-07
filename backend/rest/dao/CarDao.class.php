<?php
require_once __DIR__ . '/BaseDao.class.php';


class CarDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('cars');  
    }

    public function add_car($car) {
        return $this->insert('cars', $car);
      }

    // public function get_car_by_id($car_id){
    //     return $this->query_unique("SELECT * FROM cars WHERE id = :id", ["id" => $car_id]);
    // }

    // public function delete_car_by_id($car_id) {
    //     $this->execute("DELETE FROM cars WHERE id = :id", ["id" => $car_id]);
    // }


    

    // function getCarsWithManualTransmission(){
    // return $this->query("SELECT *
    // FROM cars
    // WHERE transmission = 'manual'");
    // }   
}
