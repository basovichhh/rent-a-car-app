<?php
//get information about all cars
Flight::route('GET /cars', function () {
    Flight::json(Flight::carService()->get_all());
});


Flight::route('POST /cars', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::carService()->add($data));
});


Flight::route('DELETE /cars/@car_id', function ($car_id) {
    Flight::carService()->delete($car_id);
});

Flight::route('GET /cars/@car_id', function ($car_id) {
    Flight::json(Flight::carService()->get_by_id($car_id));
});

Flight::route("PUT /cars/@car_id", function($car_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Vehicle info edited succesfully', 'data' => Flight::carService()->update($data, $car_id)]); 
});
