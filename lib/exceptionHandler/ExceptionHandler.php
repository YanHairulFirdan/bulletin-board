<?php

namespace Lib\ExceptionHandler;

use Lib\Logger\ErrorLogger;

class ExceptionHandler
{
    public static function handle(\Throwable $th)
    {
        $message = $th->getCode() . ' : ' . $th->getMessage() . ' in line ' . $th->getLine() . ' inside file ' . $th->getFile();

        if (MODE == 'development') {
            dump($message);
        } else {
            ErrorLogger::logMessage($message);

            if (file_exists(base_url() . 'errors/' . $th->getCode() . 'error.php')) {
                redirect(base_url() . 'errors/' . $th->getCode() . 'error.php');
            }
            // header($_SERVER["SERVER_PROTOCOL"] . ' ' . $th->getCode());
            http_response_code($th->getCode());
        }
    }
}
