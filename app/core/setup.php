<?php

if (!file_exists(ROOT . '\logs\\error.log')) {
    mkdir(ROOT . '\logs');
    touch('error.log');
}

error_reporting(DEBUG === 'off' ? 0 : E_ALL);

ini_set('log_errors', 1);
ini_set('error_log', ROOT . '\logs\\error.log');
