<?php
function required($field, $values)
{
    return empty($values) ? "{$field} Must be fill in!" : null;
}

function length($field, $value, $values)
{
    $values      = explode('-', $values);
    $min         = intval($values[0]);
    $max         = intval($values[1]);
    $message     = '';

    if (strlen($value) < $min || strlen($value) > $max) {
        $message = "Your {$field} must be {$min} to {$max} characters long";
    }
    return (!empty($message)) ? $message : null;
}
