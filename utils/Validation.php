<?php
// require_once 'helpers/file_manipulation.php';
class Validation
{
    private $messages = [
        'required'  => 'please fill in this :field field',
        'length'    => 'Your :field must be :min to :max characters'
    ];
    private $rules;
    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function validate($fields)
    {
        $messages = [];
        foreach ($fields as $key => $field) {
            if (strlen($field) == 0) {
                $messages[$key]          = str_replace(':field', $key, $this->messages['required']);
            } else {
                if (strlen($field) < $this->rules[$key]['min'] || strlen($field) > $this->rules[$key]['max']) {
                    $searches            = [':min', ':max', ':field'];
                    $replaces            = [$this->rules[$key]['min'], $this->rules[$key]['max'], $key];
                    $messages[$key]      = $this->messages['length'];
                    $messages[$key]      = str_replace($searches, $replaces, $messages[$key]);
                }
            }
        }

        return (count($messages) > 0) ? $messages : null;
    }
}
