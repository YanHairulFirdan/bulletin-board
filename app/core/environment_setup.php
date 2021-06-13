<?php

if (!file_exists('../log/errors.log')) {
    dump('not exists');
}

switch (MODE) {
    case 'staging':
        error_reporting(E_ALL);
        dump(ini_get_all());
        break;

    case 'production':
        error_reporting(0);
        break;

    default:
        error_reporting(E_ALL);
        break;
}
