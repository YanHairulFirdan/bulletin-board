<?php

function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function br()
{
    echo "<br>";
}

function load_view(string $viewName, array $viewVariables = [])
{
    if (!file_exists("public/assets/views/{$viewName}.view.php")) {
        throw new Exception("file not exists", 1);
    }

    require_once "public/assets/views/{$viewName}.view.php";
}


function root_path()
{
    return str_replace('\\', '/', dirname(__DIR__));
}

function db_default_config()
{
    $rootPath  = root_path();
    $rootPath .= '/config/database.php';
    $configs   = include root_path() . '/App/config/database.php';

    return $configs;
}

function config($config, $defaultValue = '')
{
    if (!empty($config)) {
        return $config;
    }

    if (!empty($defaultValue)) {
        return $defaultValue;
    }
}
