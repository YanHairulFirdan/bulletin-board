<?php

namespace Lib\Validation\Validators;

abstract class AbstractRule
{
    protected $message;

    public abstract function check($params);

    public function getMessage()
    {
        return $this->message;
    }
}
