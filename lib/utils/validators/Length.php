<?php

namespace Lib\Utils\Validators;

class Length extends AbstractRule
{
    public function check($params)
    {
        extract($params);

        $field      = $field;
        $requisite  = explode('-', $requisite);
        $min        = intval($requisite[0]);
        $max        = intval($requisite[1]);
        $fieldValue = sanitize_string($fieldValue);

        if (strlen($fieldValue) < $min || strlen($fieldValue) > $max) {
            $this->message = "Your {$field} must be {$min} to {$max} characters long";
        }
    }
}
