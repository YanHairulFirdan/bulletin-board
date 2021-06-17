<?php
define("DEBUG", 1);
define("TIME_ZONE", "Asia/Makassar");
define("ERROR_LEVEL", E_ALL);
define("ROOT", dirname(__DIR__));

error_reporting(ERROR_LEVEL);

ini_set('date.timezone', TIME_ZONE);
ini_set('display_errors', DEBUG);
ini_set('display_startup_errors', DEBUG);
ini_set('log_errors', 1);
