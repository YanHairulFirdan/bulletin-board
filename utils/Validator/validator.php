<?php
function required($field, $values)
{
    if (is_array($values)) {
        if ($values['error'] === 4) {
            return "{$field} is required!";
        }
    } else {
        return empty($values) ? "{$field} Must be fill in!" : null;
    }
}

function length($field, $value, $values)
{
    $values  = explode('-', $values);
    $min     = intval($values[0]);
    $max     = intval($values[1]);
    $message = '';

    if (strlen($value) < $min || strlen($value) > $max) {
        $message = "Your {$field} must be {$min} to {$max} characters long";
    }
    return (!empty($message)) ? $message : null;
}

function type($fieldName, $fieldValue, $fileType)
{
    echo "type validator called";
    $message = '';
    $values  = explode(',', $fileType);
    $type    = explode('/', $_FILES[$fieldName]['type']);
    dump($fieldValue);
    if (!in_array($type[1], $values)) {
        $message = 'File extension is not allowed';
    }
    return ($message) ? $message : null;
}
