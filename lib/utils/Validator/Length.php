<?php

namespace Lib\Utils\Validator;

class Length extends AbstractRule
{
    public function check($params)
    {
        extract($params);
        $field      = $field;
        $fieldValue = $fieldValue;
        $requisite  = explode('-', $requisite);
        $min        = intval($requisite[0]);
        $max        = intval($requisite[1]);

        if (strlen($fieldValue) < $min || strlen($fieldValue) > $max) {
            $this->message = "Your {$field} must be {$min} to {$max} characters long";
        }
    }
}
