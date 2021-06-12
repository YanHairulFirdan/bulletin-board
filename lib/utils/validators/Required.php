<?php

namespace Lib\Utils\Validators;

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

        $fieldValue = filter_var(trim($fieldValue), FILTER_SANITIZE_STRING);

        $this->message = empty($fieldValue) ? "{$field} Must be fill in!" : null;
    }
}
