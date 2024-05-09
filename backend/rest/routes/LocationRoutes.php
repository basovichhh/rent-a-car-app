<?php

Flight::route('GET /api/locations', function () {
    Flight::json(Flight::locationService()->get_all());
});


Flight::route('POST /api/locations', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::locationService()->add($data));
});

Flight::route('GET /api/locations/bookings/@location_id', function ($location_id) {
    Flight::json(Flight::locationService()->getNumberOfBookingsPerLocation($location_id));
});

Flight::route('DELETE /api/locations/@location_id', function ($location_id) {
    Flight::locationService()->delete($location_id);
});

Flight::route('GET /locations/@location_id', function ($location_id) {
    Flight::json(Flight::locationService()->get_by_id($location_id));
});

Flight::route("PUT /api/locations/@location_id", function($location_id){
    $data = Flight::request()->data->getData();
    Flight::locationService()->update($location_id, $data);
    Flight::json(Flight::locationService()->getById($location_id));
});
