<?php

namespace App\Utils\Validator;


class Length  implements IValidator
{
    private $message;

    public function check($data)
    {
        $field            = $data['field'];
        $fieldValue       = $data['fieldValue'];
        $requirementValue = explode('-', $data['requirementValue']);
        $min              = intval($requirementValue[0]);
        $max              = intval($requirementValue[1]);

        if (strlen($fieldValue) < $min || strlen($fieldValue) > $max) {
            $this->message = "Your {$field} must be {$min} to {$max} characters long";
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
