<?php
function get_request()
{
    $value = null;
    if (count($_GET) == 1) {
        $key = array_key_first($_GET);

        if (filter_var($_GET[$key], FILTER_SANITIZE_NUMBER_INT)) {
            $value = filter_var($_GET[$key], FILTER_SANITIZE_NUMBER_INT);
            $value = preg_match("/[\w]/", $value);
        }
    }

    return $value;
}
