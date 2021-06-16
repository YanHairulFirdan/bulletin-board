<?php

namespace App\Validations;

use Lib\Validation\Validation as Validator;

class BulletinValidation extends Validator
{
    protected $rules = [
        'title' => 'required|length:10-180',
        'body'  => 'required|length:10-220',
    ];
}
