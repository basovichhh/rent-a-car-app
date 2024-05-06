<?php

Flight::route('GET /locations', function () {
    Flight::json(Flight::locationService()->get_all());
});


Flight::route('POST /locations', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::locationService()->add($data));
});

Flight::route('GET /locations/bookings/@location_id', function ($location_id) {
    Flight::json(Flight::locationService()->getNumberOfBookingsPerLocation($location_id));
});

Flight::route('DELETE /locations/@location_id', function ($location_id) {
    Flight::locationService()->delete($location_id);
});

Flight::route('GET /locations/@location_id', function ($location_id) {
    Flight::json(Flight::locationService()->get_by_id($location_id));
});

Flight::route("PUT /locations/@location_id", function($location_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Location edited succesfully', 'data' => Flight::locationService()->update($data, $location_id)]); 
});
