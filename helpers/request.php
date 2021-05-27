<?php
function get_request()
{
    if (count($_GET) == 1) {
        $key = array_key_first($_GET);

        if (filter_var($_GET[$key], FILTER_SANITIZE_NUMBER_INT)) {
            $value = filter_var($_GET[$key], FILTER_SANITIZE_NUMBER_INT);

            return $value;
        };
    }
}
