<?php

namespace Lib\Logger;

interface LoggerInterface
{
    public static function createLogFile();

    public static function logMessage(string $message);
}
