<?php

namespace Lib\Validation\Validators;

class Type extends AbstractRule
{
    public function check($validationParams)
    {
        $allowedTypes = explode(',', $validationParams['requisite']);
        $currentType  = explode('/', $_FILES[$field]['type']);

        if (!in_array($currentType[1], $allowedTypes)) {
            $this->message = "File extension is not allowed. File extension must be {$requisite}";
        }
    }
}
