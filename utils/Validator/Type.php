<?php

namespace App\Utils\Validator;


class Type  implements IValidator
{
    private $message;

    public function check($data)
    {
        $types = explode(',', $data['requisite']);
        $type  = explode('/', $_FILES[$data['field']]['type']);

        if (!in_array($type[1], $types)) {
            $this->message = "File extension is not allowed. File extension must be {$data['requisite']}";
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
