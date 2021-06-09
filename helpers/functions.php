<?php

function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
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

function redirect($url, $permanent = true)
{
    header("Location: {$url}", true, $permanent ? 301 : 302);

    exit;
}


function old_input(string $key)
{
    return htmlspecialchars($_POST[$key]);
}
