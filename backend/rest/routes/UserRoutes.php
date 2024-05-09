<?php

Flight::route('GET /api/users', function () {
    Flight::json(Flight::userService()->get_all_users());
});

Flight::route('GET /api/users/@user_id', function ($user_id) {
    Flight::json(Flight::userService()->get_by_id($user_id));
});

Flight::route('GET /pi/users/@first_name/@last_name', function ($first_name, $last_name) {
    Flight::json(Flight::userService()->getCustomerByFirstNameAndLastName($first_name, $last_name));
});


Flight::route('POST /api//users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add($data));
});

Flight::route("PUT /api/users/@user_id", function($user_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Customer edited succesfully', 'data' => Flight::userService()->update($data, $user_id)]); 

});

Flight::route('DELETE /api/users/@user_id', function ($user_id) {
    Flight::userService()->delete($user_id);
});
