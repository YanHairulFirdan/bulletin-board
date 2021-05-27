<?php
function filter_get_request()
{
    if (count($_GET) == 1) {
        $key = array_key_first($_GET);
        dump($key);
    }
}
