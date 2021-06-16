<?php

namespace Lib\Logger;

interface LoggerInterface
{
    public function createLogFile();
    public function logMessage(string $message);
}
