<?php
require_once 'helpers/file_manipulation.php';
class Validation
{

    private $messages = [
        'required'  => 'please fill in this :field field',
        'length'    => 'Your :field must be :min to :max characters'
    ];
    public static $errorMessage;
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
                if (!isset($messages['type'])) {
                    $messages['type']    = 'error';
                }

                $messages[$key]          = str_replace(':field', $key, $this->messages['required']);
            } else {
                if (strlen($field) < $this->rules[$key]['min'] || strlen($field) > $this->rules[$key]['max']) {
                    $messages[$key]      = $this->messages['length'];
                    $messages[$key]      = str_replace(':min', $this->rules[$key]['min'], $messages[$key]);
                    $messages[$key]      = str_replace(':max', $this->rules[$key]['max'], $messages[$key]);
                    $messages[$key]      = str_replace(':field', $key, $messages[$key]);
                    $messages[$key]      = $messages[$key];
                }
            }
        }

        if ($messages) {
            write_file($messages);
            header("Location: index.php?");
            exit;
        }
    }
}
