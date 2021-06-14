<?php

if (!file_exists(ROOT . '\logs\\error.log')) {
    dump('not exist');
    mkdir(ROOT . '\logs');
    touch(ROOT . '\logs\\error.log');
}

error_reporting((DEBUG === 'off') ? 0 : E_ALL);

ini_set('date.timezone', TIME_ZONE);
ini_set('display_errors', (DEBUG === 'off') ? 0 : 1);
ini_set('display_startup_errors', (DEBUG === 'off') ? 0 : 1);
ini_set('log_errors', 1);
ini_set('error_log', ROOT . '\logs\\error.log');
