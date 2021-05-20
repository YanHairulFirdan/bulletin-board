<?php
function get_config_value(string $key, $defaultValue)
{
    $configs = get_defined_constants(true)['user'];

    return array_key_exists($key, $configs) ? $configs[$key] : $defaultValue;
}
