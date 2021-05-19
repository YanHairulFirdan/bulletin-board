<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

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
// if (isset($newValue) && !empty($newValue)) {
//     return $newValue;
// } else {
//     return $defaulValue;
// }
// function check_value(Type $var = null){
//     # code...
// }
