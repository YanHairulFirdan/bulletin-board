<?php

namespace Lib\Utils\Validator;

class Required extends AbstractRule
{
    public function check($data)
    {
        $field      = $data['field'];
        $fieldValue = $data['fieldValue'];

        if (is_array($fieldValue)) {
            if ($fieldValue['error'] === 4) {
                $this->message = "{$field} is required!";
                return;
            }
        }
        $this->message = empty($data['fieldValue']) ? "{$field} Must be fill in!" : null;
    }
}
