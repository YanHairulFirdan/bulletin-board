<?php

switch (MODE) {
    case 'production':
        error_reporting(0);
        break;

    default:
        error_reporting(E_ALL);
        break;
}
