<?php
//works
//get all users from database
Flight::route('GET /users', function () {
    Flight::json(Flight::userService()->get_all());
});

//works
//get all information regarding one customer based upon its id as a parameter
Flight::route('GET /users/@user_id', function ($user_id) {
    Flight::json(Flight::userService()->get_by_id($user_id));
});

//does not work
//get all information regarding one customer based upon its name and surname as parameters
Flight::route('GET /users/@first_name/@last_name', function ($first_name, $last_name) {
    Flight::json(Flight::userService()->getCustomerByFirstNameAndLastName($first_name, $last_name));
});

//works
//add a new customer to the database
Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add($data));
});

//works
//update an existing customer based upon its id as a parameter
Flight::route("PUT /users/@user_id", function($user_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Customer edited succesfully', 'data' => Flight::userService()->update($data, $user_id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});


//works
//delete one customer based upon its id as a parameter
Flight::route('DELETE /users/@user_id', function ($user_id) {
    Flight::userService()->delete($user_id);
});
