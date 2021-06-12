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

function base_url()
{
    $host       = $_SERVER['HTTP_HOST'];
    $uri        = $_SERVER['REQUEST_URI'];
    $explodeUri = explode('/', $uri);
    $pos        = array_search('public', $explodeUri);

    array_splice($explodeUri, $pos + 1);

    $baseUrl = $host . implode('/', $explodeUri) . 'index.php';

    return $baseUrl;
}
