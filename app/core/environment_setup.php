<?php

if (!file_exists('../log/errors.log')) {
    dump('not exists');
}
// dump(__DIR__);
ini_set('error_log', "E:\xampp\htdocs\BulletinBoard\log\errors.log");

// die;
switch (MODE) {
    case 'staging':
        error_reporting(E_ALL);
        // dump(ini_get_all());
        break;

    case 'production':
        error_reporting(0);
        break;

    default:
        error_reporting(E_ALL);
        break;
}
