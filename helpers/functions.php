<?php
function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function redirect($url, $code = 302)
{
    header("Location: {$url}", true, $code);

    exit;
}

function old_input(string $key)
{
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
}

function sanitize_string(string $value)
{
    return filter_var(trim($value), FILTER_SANITIZE_STRING);
}

function is_empty($value)
{
    $badValues = ['', '0'];
    return $value == ''||empty($value)? true: false;   
}
