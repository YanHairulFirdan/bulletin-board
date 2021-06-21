<?php
define("MODE", "production");
define("TIME_ZONE", "Asia/Makassar");
define("ROOT", dirname(__DIR__));

set_exception_handler(['Lib\Handler\ExceptionHandler', 'handle']);
    
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
        error_reporting(0);
        break;
    
    default:
        error_reporting(E_ALL);
        break;
}
