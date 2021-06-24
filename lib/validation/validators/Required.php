<?php

namespace Lib\Validation\Validators;

class Required extends AbstractRule
{
    public function check(array $validationParams)
    {
        $field      = $validationParams['field'];
        $fieldValue = $validationParams['fieldValue'];
        $fieldValue = is_string($fieldValue) ? sanitize_string($fieldValue) : $fieldValue['tmp_name'];

        $this->message = is_empty($fieldValue) ? "{$field} Must be fill in!" : null;
    }
}
