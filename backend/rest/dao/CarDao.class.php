<?php
require_once __DIR__ . '/BaseDao.class.php';


class CarDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('cars');  
    }

    public function add_car() {
        return $this->add('cars');
    }

    public function get_car_by_id($car_id){
        return $this->query_unique("SELECT * FROM cars WHERE id = :id", ["id" => $car_id]);
    }

    public function delete_car_by_id($car_id) {
        $this->delete('cars');
    }

    public function update_car($car_id){
        $this->update($car_id, 'cars');
    }
}
