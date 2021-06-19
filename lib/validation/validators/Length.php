<?php

namespace Lib\Validation\Validators;

class Length extends AbstractRule
{
    public function check(array $validationParams)
    {
        $field      = $validationParams['field'];
        $requisite  = explode('-', $validationParams['requisite']);
        $min        = intval($requisite[0]);
        $max        = intval($requisite[1]);
        $fieldValue = sanitize_string($validationParams['fieldValue']);

        if (strlen($fieldValue) < $min || strlen($fieldValue) > $max) {
            $this->message = "Your {$field} must be {$min} to {$max} characters long";
        }
        
    }
}