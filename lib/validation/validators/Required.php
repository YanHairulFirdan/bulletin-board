<?php

namespace Lib\Validation\Validators;

class Required extends AbstractRule
{
    public function check(array $validationParams)
    {
        $field      = $validationParams['field'];
        $fieldValue = $validationParams['fieldValue'];
        
        if (is_array($fieldValue)) {
            if ($fieldValue['error'] === 4) {
                $this->message = "{$field} is required!";
            }

            return;
        }

        $fieldValue = sanitize_string($fieldValue);
        dump(strlen($fieldValue));
        
        $this->message = is_empty($fieldValue) ? "{$field} Must be fill in!" : null;
        // $this->message = strlen($fieldValue) === 0 ? "{$field} Must be fill in!" : null;
    }
}
