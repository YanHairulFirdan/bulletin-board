<?php

function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function redirect($url, $permanent = true)
{
    header("Location: {$url}", true, $permanent ? 301 : 302);

    exit;
}

function old_input(string $key)
{
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
}
