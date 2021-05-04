<?php
require_once 'helpers/file_manipulation.php';
class Validation
{

    private $messages = [
        'required'  => 'please fill in this field',
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
            // echo $key;
            if (strlen($field) == 0) {
                $messages[$key] = $this->messages['required'];;
            } else {
                if (strlen($field) < $this->rules[$key]['min'] || strlen($field) > $this->rules[$key]['max']) {
                    $messages[$key] = $this->messages['length'];
                    $messages[$key] = str_replace(':min', $this->rules[$key]['min'], $messages[$key]);
                    $messages[$key] = str_replace(':max', $this->rules[$key]['max'], $messages[$key]);
                    $messages[$key] = str_replace(':field', $key, $messages[$key]);
                }
            }
        }

        if ($messages) {

            write_file($messages);
            header("Location: index.php?");
            exit;
        }
    }

    private function writeFile($messages)
    {
        $fileName           = 'temp/notification.txt';
        $notificationFile   = fopen($fileName, 'w') or die('Unable to open the file!!!');

        foreach ($messages as $key => $message) {
            fwrite($notificationFile, $message . '\n');
        }
        fclose($notificationFile);
    }
}
