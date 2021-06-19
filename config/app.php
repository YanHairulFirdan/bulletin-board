<?php
define("DEBUG", 1);
define("MODE", "development");
define("TIME_ZONE", "Asia/Makassar");
define("ROOT", dirname(__DIR__));


// ini_set('date.timezone', TIME_ZONE);
// ini_set('display_errors', DEBUG);
// ini_set('display_startup_errors', DEBUG);
// ini_set('error_log', ROOT . '\logs\\error.log');
switch (MODE) {
    case 'development':
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        break;
    case 'production':
        ini_set('date.timezone', TIME_ZONE);
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        ini_set('error_log', ROOT . '\logs\\error.log');
        error_reporting(E_ALL);
        break;
    
    default:
        error_reporting(E_ALL);
        break;
}
