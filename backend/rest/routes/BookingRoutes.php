<?php

Flight::route('GET /api/bookings', function () {
    Flight::json(Flight::bookingService()->get_all());
}); 


Flight::route('POST /api/bookings', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->add($data));
});


Flight::route('GET /api/bookings/paid/@location_id', function ($location_id) {
    Flight::json(Flight::bookingService()->getPaidBookingsPerLocation($location_id));
});


Flight::route('GET /api/bookings/unpaid/@location_id', function ($location_id) {
    Flight::json(Flight::bookingService()->getUnpaidBookingsPerLocation($location_id));
});


Flight::route('DELETE /api/bookings/@booking_id', function ($booking_id) {
    Flight::bookingService()->delete($booking_id);
});

Flight::route('GET /api/bookings/@booking_id', function ($booking_id) {
    Flight::json(Flight::bookingService()->get_by_id($booking_id));
});

Flight::route("PUT /api/bookings/@booking_id", function($booking_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Booking edited succesfully', 'data' => Flight::bookingService()->update($data, $booking_id)]); 
});