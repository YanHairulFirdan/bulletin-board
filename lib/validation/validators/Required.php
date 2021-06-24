<?php

namespace Lib\Validation\Validators;

class Required extends AbstractRule
{
    public function check(array $validationParams)
    {
        $fieldName  = $validationParams['fieldName'];
        $fieldValue = $validationParams['fieldValue'];
        $fieldValue = is_string($fieldValue) ? sanitize_string($fieldValue) : $fieldValue['tmp_name'];

        $this->message = is_empty($fieldValue) ? "{$fieldName} Must be fill in!" : null;
    }
}
