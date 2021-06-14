<?php

namespace Lib\Utils;

use Faker\Provider\DateTime;

class Logger
{
    private static $filePath = ROOT . "\log\\errors.txt";

    private static function createFile()
    {
        if (!file_exists(self::$filePath)) {
            mkdir(ROOT . "\log");

            touch(self::$filePath);
        }
    }

    public static function write(string $message)
    {
        self::createFile();

        $file    = fopen(self::$filePath, 'a+');
        $message = '[' . date('H:i:s d-m-Y') . '] ' . $message;

        fwrite($file, $message . PHP_EOL);
        fclose($file);
    }
}
