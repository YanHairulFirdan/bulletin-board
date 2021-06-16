<?php
define("DEBUG", 0);
define("TIME_ZONE", "Asia/Makassar");
define("ROOT", dirname(__DIR__));

error_reporting(!DEBUG ?: E_ALL);

ini_set('date.timezone', TIME_ZONE);
ini_set('display_errors', DEBUG);
ini_set('display_startup_errors', DEBUG);
ini_set('log_errors', 1);
ini_set('error_log', ROOT . '\logs\\error.log');
