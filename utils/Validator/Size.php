<?php

namespace App\Utils\Validator;


class Size implements IValidator
{
    private $message;

    public function check($data)
    {
        $field   = $data['field'];
        $maxSize = $data['requisite'] / 1000;
        $size    = $_FILES[$data['field']]['size'] / 1000;

        if ($size > $maxSize) {
            $this->message = "File size for {$field} is {$maxSize} MB";
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
