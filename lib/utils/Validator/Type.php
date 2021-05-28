<?php

namespace Lib\Utils\Validator;

class Type extends AbstractRule
{
    public function check($params)
    {
        extract($params);
        $types = explode(',', $requisite);
        $type  = explode('/', $_FILES[$field]['type']);

        if (!in_array($type[1], $types)) {
            $this->message = "File extension is not allowed. File extension must be {$requisite}";
        }
    }
}
