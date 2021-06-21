<?php

namespace Lib\Handler;

use Lib\Logger\ErrorLogger;

class ExceptionHandler  
{
    public static function handle(\Throwable $th)
    {
        $message = $th->getCode() . ' : '.$th->getMessage().' in line '.$th->getLine().' inside file '. $th->getFile();

        if (MODE == 'production') {
            ErrorLogger::logMessage($message);
            
            redirect('error.php');
        }else {
            dump($message);
        }
    }
}
