<?php

namespace Lib\Validation\Validators;

use Exception;

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
            case 'mimes':
                return new Mimes();
                break;
            case 'size':
                return new Size();
                break;
            default:
                throw new Exception("Validator type not found", 1);
                break;
        }
    }
}
