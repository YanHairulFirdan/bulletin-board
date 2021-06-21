<?php

namespace Lib\ExceptionHandler;

use Lib\Logger\ErrorLogger;

class ExceptionHandler
{
    public static function handle(\Throwable $th)
    {
        $message = $th->getCode() . ' : ' . $th->getMessage() . ' in line ' . $th->getLine() . ' inside file ' . $th->getFile();
        dump($th->getCode());

        if (MODE == 'development') {
            dump($message);
        } else {
            ErrorLogger::logMessage($message);

            redirect(BASE_URL . 'errors/' . $th->getCode() . 'error.php');
        }
    }
}
