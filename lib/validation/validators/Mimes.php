<?php

namespace Lib\Validation\Validators;

use finfo;

class Mimes extends AbstractRule
{
    public function check(array $validationParams)
    {
        $field       = $validationParams['field'];
        $file_tmp    = $validationParams['fieldValue']['tmp_name'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        $extension   = $finfo->file($file_tmp);
        $currentType = explode('/', $extension);

        if (strpos($currentType[1], $validationParams['requisite']) === false) {
            $this->message = "File extension for field {$field} is not allowed. File extension must be {$validationParams['requisite']}";
        }
    }
}
