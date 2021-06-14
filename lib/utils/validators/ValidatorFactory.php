<?php

namespace Lib\Utils\Validators;

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
            case 'type':
                return new Type();
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
