<?php
function config($config, $defaultValue = '')
{
    dump($config);
    if (!empty($config)) {
        return $config;
    }

    if (!empty($defaultValue)) {
        return $defaultValue;
    }
}
