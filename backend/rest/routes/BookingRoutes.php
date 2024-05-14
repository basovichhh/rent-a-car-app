<?php
/**
     * @OA\Get(
     *      path="/api/bookings",
     *      tags={"bookings"},
     *      summary="Get all bookings",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all bookings in the database"
     *      )
     * )
     */

Flight::route('GET /api/bookings', function () {
    Flight::json(Flight::bookingService()->get_all());
}); 

/**
     * @OA\Post(
     *      path="/api/bookings",
     *      tags={"bookings"},
     *      summary="Add booking data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Booking data, or exception if booking is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Booking data payload",
     *          @OA\JsonContent(
     *              required={"date_of_booking","date_of_payment","paid"},
     *              @OA\Property(property="date_of_booking", type="string", example="Some date", description="Booking date"),
     *              @OA\Property(property="date_of_payment", type="string", example="Some payment date", description="Payment date"),
     *              @OA\Property(property="paid", type="string", example="Paid value", description="Paid value"),
     *          )
     *      )
     * )
     */


Flight::route('POST /api/bookings', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->add('bookings', $data));
});


 /**
     * @OA\Delete(
     *      path="/api/bookings/{booking_id}",
     *      tags={"bookings"},
     *      summary="Delete booking by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted booking data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="booking_id", example="1", description="Booking ID")
     * )
     */

Flight::route('DELETE /api/bookings/@booking_id', function ($booking_id) {
    Flight::bookingService()->delete($booking_id);
});

/**
     * @OA\Get(
     *      path="/api/bookings/{booking_id}",
     *      tags={"bookings"},
     *      summary="Get bookings by id",
     *      @OA\Response(
     *           response=200,
     *           description="Booking data, or false if booking does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="booking_id", example="1", description="Booking ID")
     * )
     */

Flight::route('GET /api/bookings/@booking_id', function ($booking_id) {
    Flight::json(Flight::bookingService()->get_by_id($booking_id));
});

Flight::route("PUT /api/bookings/@booking_id", function($booking_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Booking edited succesfully', 'data' => Flight::bookingService()->update($data, $booking_id)]); 
});

Flight::route('GET /api/bookings/paid/@location_id', function ($location_id) {
    Flight::json(Flight::bookingService()->getPaidBookingsPerLocation($location_id));
});

Flight::route('GET /api/bookings/unpaid/@location_id', function ($location_id) {
    Flight::json(Flight::bookingService()->getUnpaidBookingsPerLocation($location_id));
});