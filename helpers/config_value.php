<?php
function get_config_value(string $key, $defaultValue = '')
{
    $configs = get_defined_constants(true)['user'];

    if (array_key_exists($key, $configs)) {
        return $configs[$key];
    } else {
        if (!empty($defaultValue)) {
            return $defaultValue;
        }
    }
}
