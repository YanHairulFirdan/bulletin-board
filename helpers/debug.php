<?php
function dump($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function replace_params()
{
    foreach ($_GET as $key => $get) {
        $get = str_replace('+', ' ', $get);
    }
}
