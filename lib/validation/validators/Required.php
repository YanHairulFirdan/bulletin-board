<?php

namespace Lib\Validation\Validators;

class Required extends AbstractRule
{
    public function check(array $validationParams)
    {
        $fieldName  = $validationParams['fieldName'];
        $fieldValue = $validationParams['fieldValue'];
        $fieldValue = is_string($fieldValue) ? $fieldValue : $fieldValue['tmp_name'];

        $this->message = is_empty($fieldValue) ? "{$fieldName} Must be fill in or required!" : null;
    }
}
