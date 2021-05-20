<?php

namespace App\Utils\Validator;

class Required  implements IValidator
{
    private $message;
    public function check($data)
    {
        $field      = $data['field'];
        $fieldValue = $data['fieldValue'];

        if (is_array($fieldValue)) {
            if ($fieldValue['error'] === 4) {
                $this->message = "{$field} is required!";
            }
        } else {
            $this->message = empty($data['fieldValue']) ? "{$field} Must be fill in!" : null;
        }
    }
    public function getMessage()
    {
        return $this->message;
    }
}
