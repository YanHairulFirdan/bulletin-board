<?php

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
        # code...
        break;
}