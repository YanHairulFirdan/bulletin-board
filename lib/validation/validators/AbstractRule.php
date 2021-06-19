<?php

namespace Lib\Validation\Validators;

abstract class AbstractRule
{
    protected $message;

    public abstract function check(array $validationParams);

    public function getMessage()
    {
        return $this->message;
    }
}
