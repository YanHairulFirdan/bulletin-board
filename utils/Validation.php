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
    public function validate($fields)
    {
        $messages   = [];

        foreach ($fields as $fieldKey => $field) {
            $currentFieldrules = explode('|', $this->rules[$fieldKey]);

            foreach ($currentFieldrules as $currentKeyRule => $fieldRule) {
                $findSeparator = strpos($fieldRule, ':');

                if (is_numeric($findSeparator)) {
                    $ruleContainValue       = explode(':', $fieldRule);
                    $messages[$fieldKey]    = $ruleContainValue[0]($fieldKey, $field, $ruleContainValue[1]);
                } else {
                    $messages[$fieldKey]    = $fieldRule($fieldKey, $field);
                }


                if (!empty($messages[$fieldKey])) {
                    break;
                } else {
                    unset($messages[$fieldKey]);
                }
            }
        }

        return (count($messages) > 0) ? $messages : null;
    }
}
