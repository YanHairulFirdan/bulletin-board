<?php

namespace App\Utils;

use App\Utils\Validator\ValidatorFactory;

class Validation
{
    private $rules;
    private $data;
    private $validatorClass;
    private $errorMessages;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function validate($formData)
    {
        foreach ($formData as $field => $fieldValue) {
            if (!key_exists($field, $this->rules)) {
                continue;
            }

            $currentFieldrules = explode('|', $this->rules[$field]);

            foreach ($currentFieldrules as $currentKeyRule => $fieldRule) {
                $this->setValidatorType($fieldRule, $field, $fieldValue);

                $validator = ValidatorFactory::create($this->validatorClass);

                $validator->check($this->data);

                $this->errorMessages[$field] = $validator->getMessage();

                if (!empty($this->errorMessages[$field])) {
                    break;
                } else {
                    unset($this->errorMessages[$field]);
                }
            }
        }
    }

    public function getErrorMessage()
    {
        return (count($this->errorMessages) > 0) ? $this->errorMessages : null;
    }

    private function setValidatorType($fieldRule, $field, $fieldValue)
    {
        $findSeparator = strpos($fieldRule, ':');

        if (is_numeric($findSeparator)) {
            $ruleContainValue     = explode(':', $fieldRule);
            $this->validatorClass = $ruleContainValue[0];
            $this->data           = [
                'field'      => $field,
                'fieldValue' => $fieldValue,
                'requisite'  => $ruleContainValue[1]
            ];
        } else {
            $this->validatorClass = $fieldRule;
            $this->data           = [
                'field'      => $field,
                'fieldValue' => $fieldValue
            ];
        }
    }
}
