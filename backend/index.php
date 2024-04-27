<?php

require 'vendor/autoload.php';

// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BookingService.php';
require_once __DIR__ . '/services/LocationService.php';
require_once __DIR__ . '/services/ReviewService.php';
require_once __DIR__ . '/services/CarService.php';

Flight::register('userService', "UserService");
Flight::register('bookingService', "BookingService");
Flight::register('locationService', "LocationService");
Flight::register('reviewService', "ReviewService");
Flight::register('carService', "CarService");

// import all routes
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/BookingRoutes.php';
require_once __DIR__ . '/routes/LocationRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/CarRoutes.php';

// it is still possible to add custom routes after the imports
Flight::route('GET /api/', function () {
    echo "Hello";
});

Flight::start();
?>