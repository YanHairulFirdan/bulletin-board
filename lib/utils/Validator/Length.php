<?php

namespace Lib\Utils\Validator;

class Length extends AbstractRule
{
    public function check($data)
    {
        $field      = $data['field'];
        $fieldValue = $data['fieldValue'];
        $requisite  = explode('-', $data['requisite']);
        $min        = intval($requisite[0]);
        $max        = intval($requisite[1]);

        if (strlen($fieldValue) < $min || strlen($fieldValue) > $max) {
            $this->message = "Your {$field} must be {$min} to {$max} characters long";
        }
    }
}
