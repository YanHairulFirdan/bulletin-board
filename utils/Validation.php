<?php
require_once 'Validator/validator.php';
require_once 'helpers/functions.php';
class Validation
{
    // private $messages = [
    //     'required'  => 'please fill in this :field field',
    //     'length'    => 'Your :field must be :min to :max characters'
    // ];

    private $rules;
    public function __construct($rules)
    {
        $this->rules = $rules;
    }
    public function validate($values)
    {
        $messages   = [];

        foreach ($values as $field => $value) {
            $currentFieldrules = explode('|', $this->rules[$field]);

            foreach ($currentFieldrules as $currentKeyRule => $fieldRule) {
                $findSeparator = strpos($fieldRule, ':');

                if (is_numeric($findSeparator)) {
                    $ruleContainValue       = explode(':', $fieldRule);
                    $messages[$field]    = $ruleContainValue[0]($field, $value, $ruleContainValue[1]);
                } else {
                    $messages[$field]    = $fieldRule($field, $value);
                }


                if (!empty($messages[$field])) {
                    break;
                } else {
                    unset($messages[$field]);
                }
            }
        }

        return (count($messages) > 0) ? $messages : null;
    }
}
