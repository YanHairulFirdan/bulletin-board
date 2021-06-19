<?php

namespace Lib\Validation\Validators;

class Required extends AbstractRule
{
    public function check($params)
    {
        extract($params);

        $field = $field;

        if (is_array($fieldValue)) {
            if ($fieldValue['error'] === 4) {
                $this->message = "{$field} is required!";
            }

            return;
        }

        $fieldValue = sanitize_string($fieldValue);
        
        $this->message = empty($fieldValue) ? "{$field} Must be fill in!" : null;
        // $this->message = strlen($fieldValue) === 0 ? "{$field} Must be fill in!" : null;
    }
}
