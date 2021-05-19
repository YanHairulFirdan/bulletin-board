<?php

namespace App\Utils;

use App\Utils\Validator\ValidatorFactory;

class Validation
{
    // private $messages = [
    //     'required'  => 'please fill in this :field field',
    //     'length'    => 'Your :field must be :min to :max characters'
    // ];

    private $rules;
    private $data;
    private $validatorClass;
    public function __construct($rules)
    {
        $this->rules = $rules;
    }
    public function validate($values)
    {
        $messages       = [];
        $data           = [];
        $validatorClass = '';
        foreach ($values as $field => $value) {
            $currentFieldrules = explode('|', $this->rules[$field]);

            foreach ($currentFieldrules as $currentKeyRule => $fieldRule) {
                $findSeparator = strpos($fieldRule, ':');

                if (is_numeric($findSeparator)) {
                    $ruleContainValue = explode(':', $fieldRule);
                    $this->validatorClass   = $ruleContainValue[0];
                    $this->data             = [
                        'field'            => $field,
                        'fieldValue'       => $value,
                        'requirementValue' => $ruleContainValue[1]
                    ];
                } else {
                    $this->validatorClass = $fieldRule;
                    $this->data           = [
                        'field'      => $field,
                        'fieldValue' => $value
                    ];
                }

                // require_once "Validator/{$this->validatorClass}.php";
                $validator = ValidatorFactory::create($this->validatorClass);

                $validator->check($this->data);

                $messages[$field] = $validator->getMessage();

                if (!empty($messages[$field])) {
                    break;
                } else {
                    unset($messages[$field]);
                }
            }
        }

        return (count($messages) > 0) ? $messages : null;
    }

    private function setValidaotorType($currentFieldrules)
    {
        # code...
    }
}
