<?php

namespace App\Validations;

use Lib\Utils\Validation;

class BulletinValidation extends Validation
{
    protected $rules = [
        'title' => 'required|length:10-180',
        'body'  => 'required|length:10-220',
    ];
}
