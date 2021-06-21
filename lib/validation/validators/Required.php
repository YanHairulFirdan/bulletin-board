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
        var_dump(strlen($fieldValue));
        var_dump($fieldValue);
        // dump(strlen($fieldValue));
        // var_dump(0==="0");
        
        $this->message = empty($fieldValue) ? "{$field} Must be fill in!" : null;
        // $this->message = strlen($fieldValue) === 0 ? "{$field} Must be fill in!" : null;
    }
}
