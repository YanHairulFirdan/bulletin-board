<?php

namespace Lib\Logger;

class ErrorLog implements LoggerInterface
{
    public function createLogFile()
    {
        if (!file_exists(ROOT . '\logs\\error.log')) {
            mkdir(ROOT . '\logs');
            touch(ROOT . '\logs\\error.log');
        }
    }

    public function logMessage(string $message)
    {
        $this->createLogFile();
        error_log($message);
    }
}
