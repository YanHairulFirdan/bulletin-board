<?php
define("DEBUG", 1);
define("MODE", "Development");
define("TIME_ZONE", "Asia/Makassar");
define("ROOT", dirname(__DIR__));

error_reporting(E_ALL);

ini_set('date.timezone', TIME_ZONE);
ini_set('display_errors', DEBUG);
ini_set('display_startup_errors', DEBUG);
ini_set('error_log', ROOT . '\logs\\error.log');
