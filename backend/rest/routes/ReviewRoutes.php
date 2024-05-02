<?php
Flight::route('GET /reviews', function () {
    Flight::json(Flight::reviewService()->get_all());
});

Flight::route('POST /reviews', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->add($data));
});


Flight::route('GET /reviews/reviewscores/@review_score', function ($review_score) {
    Flight::json(Flight::reviewService()->getCarsWithCertainScores($review_score));
});

Flight::route('DELETE /reviews/@review_id', function ($review_id) {
    Flight::reviewService()->delete($review_id);
});

Flight::route('GET /reviews/@review_id', function ($review_id) {
    Flight::json(Flight::reviewService()->get_by_id($review_id));
});

Flight::route("PUT /reviews/@review_id", function($review_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Review edited succesfully', 'data' => Flight::reviewService()->update($data, $review_id)]); 
});
