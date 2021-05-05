<?php
require_once 'Field.php';
class Length  implements Field
{
    private $data;
    private $errorMessage, $min, $max, $type;
    public function __construct($data, $min, $max, $type)
    {
        $this->data = $data;
        $this->type = $type;
        $this->min = $min;
        $this->max = $max;
    }

    public function check()
    {
        if (strlen($this->data) < $this->min || strlen(($this->data) > $this->max)) {
            $this->errorMessage = "Your {$this->type} must be {$this->min} to {$this->max} characters long";
        }
    }

    public function message()
    {
        return $this->errorMessage;
    }
}
