<?php

namespace Lib\Utils;

use Lib\Utils\Validator\ValidatorFactory;

class Validation
{
    private $rules;
    private $validationParams;
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

                $validator->check($this->validationParams);

                if ($validator->getMessage()) {
                    $this->errorMessages[$field] = $validator->getMessage();

                    break;
                }
            }
        }
    }

    public function getErrorMessage()
    {
        return ($this->errorMessages) ? $this->errorMessages : null;
    }

    private function setValidatorType($fieldRule, $field, $fieldValue)
    {
        $this->validatorClass                 = $fieldRule;
        $this->validationParams['field']      = $field;
        $this->validationParams['fieldValue'] = $fieldValue;

        if (is_numeric(strpos($fieldRule, ':'))) {
            $ruleContainValue                    = explode(':', $fieldRule);
            $this->validatorClass                = $ruleContainValue[0];
            $this->validationParams['requisite'] = $ruleContainValue[1];
        }
    }
}
