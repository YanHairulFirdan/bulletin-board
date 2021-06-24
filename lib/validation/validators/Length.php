<?php

namespace Lib\Validation\Validators;

class Length extends AbstractRule
{
    public function check(array $validationParams)
    {
        $fieldName  = $validationParams['fieldName'];
        $requisite  = explode('-', $validationParams['requisite']);
        $min        = intval($requisite[0]);
        $max        = intval($requisite[1]);
        $fieldValue = $validationParams['fieldValue'];

        if (strlen($fieldValue) < $min || strlen($fieldValue) > $max) {
            $this->message = "Your {$fieldName} must be {$min} to {$max} characters long";
        }
    }
}
