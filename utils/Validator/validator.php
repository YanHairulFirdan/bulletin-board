<?php
function required($field, $data)
{
    return empty($data) ? "{$field} Must be fill in!" : null;
}

function length($field, $value, $data)
{
    $data        = explode('-', $data);
    $min         = intval($data[0]);
    $max         = intval($data[1]);
    $message     = '';
    if (strlen($value) < $min || strlen($value) > $max) {
        $message = "Your {$field} must be {$min} to {$max} characters long";
    }
    return (!empty($message)) ? $message : null;
}
