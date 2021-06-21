<?php
define("MODE", "production");
define("TIME_ZONE", "Asia/Makassar");
define("ROOT", dirname(__DIR__));
define("BASE_URL", "http://localhost/bulletinboard/public/");

set_exception_handler(['Lib\ExceptionHandler\ExceptionHandler', 'handle']);
ini_set('date.timezone', TIME_ZONE);
error_reporting(E_ALL);

switch (MODE) {
    case 'development':
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        break;
    case 'staging':
    case 'production':
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        ini_set('error_log', ROOT . '\logs\\error.log');
        break;
    default:
        break;
}
