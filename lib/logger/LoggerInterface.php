<?php

namespace Lib\Logger;

interface LoggerInterface
{
    public function createFile();
    public function logMessage();
}
