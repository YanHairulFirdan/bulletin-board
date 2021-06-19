<?php

namespace Lib\Validation\Validators;

class Size extends AbstractRule
{
    private $unit = 1000;

    public function check($validationParams)
    {
        $maxSize = $validationParams['requisite'];
        $size    = $_FILES[$field]['size']  / $this->unit;

        if ($size > $maxSize) {
            $this->message = "File max size for {$field} is {$maxSize} MB";
        }
    }
}
