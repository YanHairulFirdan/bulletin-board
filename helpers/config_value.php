<?php
function config(string $key, $defaultValue = '')
{
    $configs = get_defined_constants(true)['user'];

    if (array_key_exists($key, $configs)) {
        return $configs[$key];
    }

    if (!empty($defaultValue)) {
        return $defaultValue;
    }
}
