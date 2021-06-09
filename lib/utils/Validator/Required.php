<?php

namespace Lib\Utils\Validator;

class Required extends AbstractRule
{
    public function check($params)
    {
        extract($params);

        $field      = $field;
        $fieldValue = $fieldValue;

        if (is_array($fieldValue)) {
            if ($fieldValue['error'] === 4) {
                $this->message = "{$field} is required!";
                return;
            }
        }

        $this->message = empty($fieldValue) ? "{$field} Must be fill in!" : null;
    }
}
