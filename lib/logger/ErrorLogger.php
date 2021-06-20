<?php

namespace Lib\Logger;

class ErrorLogger implements LoggerInterface
{
    public static function createLogFile()
    {
        if (!file_exists(ROOT . '\logs\\error.log')) {
            mkdir(ROOT . '\logs');
            touch(ROOT . '\logs\\error.log');
        }
    }

    public static function logMessage(string $message)
    {
        self::createLogFile();
        dump('called inside error logger');
        error_log($message);
    }
}
