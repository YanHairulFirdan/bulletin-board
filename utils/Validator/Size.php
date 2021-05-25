<?php

namespace App\Utils\Validator;


class Size extends AbstractRule
{
    private $unit = 1000;

    public function check($data)
    {
        $field   = $data['field'];
        $maxSize = $data['requisite'];
        $size    = $_FILES[$data['field']]['size']  / $this->unit;

        if ($size > $maxSize) {
            $this->message = "File max size for {$field} is {$maxSize} MB";
        }
    }
}
