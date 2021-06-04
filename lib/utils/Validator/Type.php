<?php

namespace Lib\Utils\Validator;

class Type extends AbstractRule
{
    public function check($params)
    {
        extract($params);

        $allowedTypes = explode(',', $requisite);
        $currentType  = explode('/', $_FILES[$field]['type']);

        if (!in_array($currentType[1], $allowedTypes)) {
            $this->message = "File extension is not allowed. File extension must be {$requisite}";
        }
    }
}
