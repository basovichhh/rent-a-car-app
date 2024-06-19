<?php

/**
     * @OA\Get(
     *      path="/api/users",
     *      tags={"users"},
     *      summary="Get all users",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Array of all users in the database"
     *      )
     * )
     */

Flight::route('GET /api/users', function () {
    Flight::json(Flight::userService()->get_all_users());
});

/**
     * @OA\Get(
     *      path="/api/users/{user_id}",
     *      tags={"users"},
     *      summary="Get user by id",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="User data, or false if user does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="user_id", example="1", description="User ID")
     * )
     */

Flight::route('GET api/users/@user_id', function ($user_id) {
    Flight::json(Flight::userService()->get_user_by_id($user_id));

    // $user = Flight::get('userService')->get_user_by_id($user_id);

    // Flight::json($user, 200);
});

Flight::route('GET /api/users/@first_name/@last_name', function ($first_name, $last_name) {
    Flight::json(Flight::userService()->getCustomerByFirstNameAndLastName($first_name, $last_name));
});

/**
     * @OA\Post(
     *      path="/api/users",
     *      tags={"users"},
     *      summary="Add user data to the database",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="User data, or exception if user is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="User data payload",
     *          @OA\JsonContent(
     *              required={"email","pwd","first_name", "last_name"},
     *              @OA\Property(property="email", type="string", example="example@user.com", description="User email"),
     *              @OA\Property(property="pwd", type="string", example="Some pwd of user", description="User pwd"),
     *              @OA\Property(property="first_name", type="string", example="Some name", description="User name"),
     *              @OA\Property(property="last_name", type="string", example="Some last name", description="User last name")
     *          )
     *      )
     * )
     */


Flight::route('POST /api/users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add_user($data));
});

 /**
     * @OA\Delete(
     *      path="/api/users/{user_id}",
     *      tags={"users"},
     *      summary="Delete user by id",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Deleted user data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="user_id", example="1", description="User ID")
     * )
     */

Flight::route('DELETE /api/users/@user_id', function ($user_id) {
    Flight::userService()->delete($user_id);
});

/**
 * @OA\Put(
 *      path="/api/users/{user_id}/update-profile",
 *      tags={"users"},
 *      summary="Update user profile (password and/or bio)",
 *      security={
 *          {"ApiKey": {}}
 *      },
 *      @OA\Response(
 *           response=200,
 *           description="Profile updated successfully"
 *      ),
 *      @OA\RequestBody(
 *          description="Profile update payload",
 *          @OA\JsonContent(
 *              required={"current_password", "new_password", "bio"},
 *              @OA\Property(property="current_password", type="string", example="current_password", description="Current user password"),
 *              @OA\Property(property="new_password", type="string", example="new_password", description="New user password"),
 *              @OA\Property(property="bio", type="string", example="Updated bio content", description="New user bio")
 *          )
 *      )
 * )
 */
Flight::route('PUT /api/users/@user_id/update-profile', function ($user_id) {
    $data = Flight::request()->data->getData();

    $updatedPassword = isset($data['new_password']) ? $data['new_password'] : null;
    $bio = isset($data['bio']) ? $data['bio'] : null;

    // Example validation (you should add more robust validation based on your requirements)
    if (empty($updatedPassword) && empty($bio)) {
        Flight::halt(400, 'Either new_password or bio must be provided for update.');
    }

    // Update password if new_password is provided
    if (!empty($updatedPassword)) {
        $currentPassword = $data['current_password']; // Ensure you have current password for verification
        // Call your userService method to update password
        Flight::userService()->updatePassword($user_id, $currentPassword, $updatedPassword);
    }

    // Update bio if bio is provided
    if (!empty($bio)) {
        // Call your userService method to update bio
        Flight::userService()->updateBio($user_id, $bio);
    }

    // Optionally, you can return a success message or updated user data
    Flight::json(['message' => 'Profile updated successfully']);
});


Flight::route("PUT /api/users/@user_id", function($user_id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'User edited succesfully', 'data' => Flight::userService()->update($data, $user_id)]); 

});




