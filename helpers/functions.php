<?php
function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function replace_params()
{
    $errorMessage = [];
    foreach ($_GET as $key => $get) {
        // echo $key;
        echo stristr($key, 'error') ? 'true' : 'false';
        if (stristr($key, 'error') || stristr($key, 'success')) {
            echo $get;
            // $get = str_replace('+', ' ', $get);
            // $p
            $errorMessage[$key] = str_replace('+', ' ', $get);
        }
    }

    return (count($errorMessage) > 0) ? $errorMessage : null;
}
