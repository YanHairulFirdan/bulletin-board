<?php

namespace Lib\Validation\Validators;

class Size extends AbstractRule
{
    private $unit = 1000;

    public function check($validationParams)
    {
        $fieldName   = $validationParams['fielddName'];
        $fielValue   = $validationParams['fieldValue'];
        $maxSize     = $validationParams['requisite'];
        $size        = $fielValue['size'] / $this->unit;

        if ($size > $maxSize) {
            $this->message = "File max size for {$fieldName} is {$maxSize} KB";
        }
    }
}
