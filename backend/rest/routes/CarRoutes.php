<?php
//works
//get information about all cars
Flight::route('GET /cars', function () {
    Flight::json(Flight::carService()->get_all());
});

/*works, however here when I get a randomly generated primary key, 
this one is way bigger than autoincrementation, and this happens only with this class*/
Flight::route('POST /cars', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::carService()->add($data));
});


//works
Flight::route('DELETE /cars/@car_id', function ($car_id) {
    Flight::carService()->delete($car_id);
});

//works
Flight::route('GET /cars/@car_id', function ($car_id) {
    Flight::json(Flight::carService()->get_by_id($car_id));
});

//works
Flight::route("PUT /cars/@car_id", function($car_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Vehicle info edited succesfully', 'data' => Flight::carService()->update($data, $car_id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});
