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

function load_view(string $viewName, $params)
{
    extract($params);
    if (!file_exists("public/assets/views/{$viewName}.view.php")) {
        throw new Exception("file not exists", 1);
    }

    require_once "public/assets/views/{$viewName}.view.php";
}


function get_root_path()
{
    return str_replace('\\', '/', dirname(__DIR__));
}

function db_default_config()
{
    $rootPath  = get_root_path();
    $rootPath .= '/config/database.php';
    $configs   = include get_root_path() . '/config/database.php';

    return $configs;
}
