<?php

// set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

// Database access credentials
define('DB_NAME', 'rent_a_car');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', '127.0.0.1'); // localhost

// JWT Secret 

define('JWT_Secret', 'd;Tef?mM5V_n*L(-{*L@.0&21rxN}C');

