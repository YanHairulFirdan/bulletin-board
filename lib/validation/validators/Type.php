<?php

namespace Lib\Validation\Validators;

class Type extends AbstractRule
{
    public function check(array $validationParams)
    {
        $field       = $validationParams['field'];        
        $currentType = explode('/', $_FILES[$field]['type']);
        
        if (strpos($currentType[1], $validationParams['requisite']) === false) {
            $this->message = "File extension for field {$field} is not allowed. File extension must be {$validationParams['requisite']}";
        }
    }
}
