<?php

namespace Lib\Handler;

use Lib\Logger\ErrorLogger;

class ExceptionHandler  
{
    public static function handle(\Exception $e)
    {
        $message = $e->getCode() . ' : '.$e->getMessage().' in line '.$e->getLine().' inside file '. $e->getFile();

        if (MODE == 'production') {
            ErrorLogger::logMessage($message);
            
            redirect('error.php');
        }else {
            dump($message);
        }
    }
}
