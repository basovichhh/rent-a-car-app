<?php
//get information about all cars

/**
     * @OA\Get(
     *      path="/api/cars",
     *      tags={"cars"},
     *      summary="Get all cars",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all cars in the database"
     *      )
     * )
     */
Flight::route('GET /api/cars', function () {
    Flight::json(Flight::carService()->get_all());
});

/**
     * @OA\Post(
     *      path="/api/cars",
     *      tags={"cars"},
     *      summary="Add car data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Car data, or exception if car is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Car data payload",
     *          @OA\JsonContent(
     *              required={"name","manufacturer","email"},
     *              @OA\Property(property="id", type="string", example="1", description="Car ID"),
     *              @OA\Property(property="name", type="string", example="Some car name", description="Car model name"),
     *              @OA\Property(property="manufacturer", type="string", example="Some manufacturer name", description="Car manufacturer name"),
     *              @OA\Property(property="fuel", type="string", example="Diesel", description="Car fuel type"),
     *              @OA\Property(property="transmission", type="string", example="manual", description="Car transmission type")
     *          )
     *      )
     * )
     */

Flight::route('POST /api/cars', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::carService()->add_car($data));
});


Flight::route('DELETE /api/cars/@car_id', function ($car_id) {
    Flight::carService()->delete($car_id);
});

Flight::route('GET /api/cars/@car_id', function ($car_id) {
    Flight::json(Flight::carService()->get_by_id($car_id));
});

Flight::route("PUT /api/cars/@car_id", function($car_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Vehicle info edited succesfully', 'data' => Flight::carService()->update($data, $car_id)]); 
});
