<?php

function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function check_value($index, $defaulValue, $ConfigArr)
{

    if (array_key_exists($index, $ConfigArr)) {
        if (strlen($ConfigArr[$index]) > 0) {
            return $ConfigArr[$index];
        } else
            return $defaulValue;
    } else
        return $defaulValue;
}

function br()
{
    echo "<br>";
}

function load_view(string $viewName, $data)
{
    if (file_exists("public/assets/views/{$viewName}.view.php")) {
        return require_once "public/assets/views/{$viewName}.view.php";
    } else {
        throw new Exception("file not exists", 1);
    }
}
