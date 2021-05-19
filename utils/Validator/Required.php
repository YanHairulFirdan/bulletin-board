<?php

namespace App\Utils\Validator;

class Required  implements IValidator
{
    private $message;
    public function check($data)
    {
        $field         = $data['field'];
        $fieldValue    = $data['fieldValue'];

        $this->message =  empty($fieldValue) ? "{$field} Must be fill in!" : null;
    }
    public function getMessage()
    {
        return $this->message;
    }
}
