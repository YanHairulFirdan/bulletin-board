<?php
function get_request()
{
    if (count($_GET) == 1) {
        $key   = array_key_first($_GET);
        $getParam = $_GET[$key];
        if (intval($getParam) > 0) {
            $getParam = filter_var($_GET[$key], FILTER_SANITIZE_NUMBER_INT);
        } else {
            $getParam = filter_var($_GET[$key], FILTER_SANITIZE_STRING);
        }
    }

    return $getParam;
}
