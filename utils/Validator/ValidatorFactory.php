<?php

namespace App\Utils\Validator;

class ValidatorFactory
{
    public static function create(string $validatorType)
    {
        switch ($validatorType) {
            case 'required':
                return new Required();
                break;
            case 'length':
                return new Length();
                break;
            case 'type':
                return new Type();
                break;
            case 'size':
                return new Size();
                break;
        }
    }
}
