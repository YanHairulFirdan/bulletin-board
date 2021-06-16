<?php

namespace Lib\Utils\Validators;

abstract class AbstractRule
{
    protected $message;

    public abstract function check($params);

    public function getMessage()
    {
        return $this->message;
    }
}
