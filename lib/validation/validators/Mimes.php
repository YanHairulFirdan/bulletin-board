<?php

namespace Lib\Validation\Validators;

use finfo;

class Mimes extends AbstractRule
{
    public function check(array $validationParams)
    {
        $fieldName = $validationParams['fieldName'];
        $file_tmp  = $validationParams['fieldValue']['tmp_name'];

        $finfo     = new finfo(FILEINFO_MIME_TYPE);
        $extension = $finfo->file($file_tmp);

        if (strpos($validationParams['requisite'], $extension) === false) {
            $this->message = "File extension for field {$fieldName} is not allowed. File extension must be {$validationParams['requisite']}";
        }
    }
}
