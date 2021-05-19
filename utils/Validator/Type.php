<?php

namespace App\Utils\Validator;


class Type  implements IValidator
{
    private $message;

    public function check($data)
    {
        $values = explode(',', $data['field']);
        $type   = explode('/', $_FILES[$data['field']]['type']);

        if (!in_array($type[1], $values)) {
            $this->message = 'File extension is not allowed';
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
