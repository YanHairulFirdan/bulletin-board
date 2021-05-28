<?php
function config($config, $defaultValue = '')
{
    if (!empty($config)) {
        return $config;
    }

    if (!empty($defaultValue)) {
        return $defaultValue;
    }
}
