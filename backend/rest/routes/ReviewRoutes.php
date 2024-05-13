<?php
/**
     * @OA\Get(
     *      path="/api/reviews",
     *      tags={"reviews"},
     *      summary="Get all reviews",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all reviews in the database"
     *      )
     * )
     */


Flight::route('GET /api/reviews', function () {
    Flight::json(Flight::reviewService()->get_all());
});

/**
 * @OA\Post(
 *      path="/api/reviews",
 *      tags={"reviews"},
 *      summary="Add reviews data to the database",
 *      @OA\Response(
 *           response=200,
 *           description="Review data, or exception if review is not added properly"
 *      ),
 *      @OA\RequestBody(
 *          description="Review data payload",
 *          @OA\JsonContent(
 *              required={"booking_id","review_score"},
 *              @OA\Property(property="booking_id", type="integer", example=1, description="Booking id"),
 *              @OA\Property(property="review_score", type="integer", example=5, description="Review score")        
 *          )
 *      )
 * )
 */


Flight::route('POST /api/reviews', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->add($data));
});

 /**
     * @OA\Delete(
     *      path="/api/reviews/{review_id}",
     *      tags={"reviews"},
     *      summary="Delete review by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted review data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="review_id", example="1", description="Review ID")
     * )
     */




Flight::route('DELETE /api/reviews/@review_id', function ($review_id) {
    Flight::reviewService()->delete($review_id);
});

/**
     * @OA\Get(
     *      path="/api/reviews/{review_id}",
     *      tags={"reviews"},
     *      summary="Get review by id",
     *      @OA\Response(
     *           response=200,
     *           description="Review data, or false if review does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="review_id", example="1", description="Review ID")
     * )
     */

Flight::route('GET /api/reviews/@review_id', function ($review_id) {
    Flight::json(Flight::reviewService()->get_by_id($review_id));
});



Flight::route("PUT /api/reviews/@review_id", function($review_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Review edited succesfully', 'data' => Flight::reviewService()->update($data, $review_id)]); 
});
