<?php

namespace App\Utils\Validator;

interface IValidator
{
    public function check($data);
    public function getMessage();
}
