<?php

namespace Lib\Handler;

use Lib\Logger\ErrorLogger;

class ExceptionHandler  
{
    public static function handle(\Throwable $th)
    {
        if (MODE == 'production') {
            ErrorLogger::logMessage($th->getMessage());
            echo 'called';
            redirect('error.php');
        }else {
            dump($th->getMessage());
        }
    }
}
