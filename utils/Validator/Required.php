<?php
require_once 'Field.php';
class Required  implements Field
{
    private $data;
    private $errorMessage;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function check()
    {
        if ((empty($this->data))) {
            $this->errorMessage = 'Must be fill in';
        }
    }

    public function message()
    {
        return $this->errorMessage;
    }
}
