<?php

namespace App\Utils\Validator;

abstract class AbstractRule
{
    protected $message;
    public abstract function check($data);
    public function getMessage()
    {
        return $this->message;
    }
}
