<?php

Flight::route('GET /bookings', function () {
    Flight::json(Flight::bookingService()->get_all());
}); 


Flight::route('POST /bookings', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->add($data));
});


Flight::route('GET /bookings/paid/@location_id', function ($location_id) {
    Flight::json(Flight::bookingService()->getPaidBookingsPerLocation($location_id));
});


Flight::route('GET /bookings/unpaid/@location_id', function ($location_id) {
    Flight::json(Flight::bookingService()->getUnpaidBookingsPerLocation($location_id));
});


Flight::route('DELETE /bookings/@booking_id', function ($booking_id) {
    Flight::bookingService()->delete($booking_id);
});

Flight::route('GET /bookings/@booking_id', function ($booking_id) {
    Flight::json(Flight::bookingService()->get_by_id($booking_id));
});

Flight::route("PUT /bookings/@booking_id", function($booking_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Booking edited succesfully', 'data' => Flight::bookingService()->update($data, $booking_id)]); 
});