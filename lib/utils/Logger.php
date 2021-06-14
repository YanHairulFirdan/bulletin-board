<?php

namespace Lib\Utils;

use Faker\Provider\DateTime;

class Logger
{
    private static $filePath = "E:/xampp/htdocs/BulletinBoard/log/errors.txt";

    private static function createFile()
    {
        if (!file_exists(self::$filePath)) {
            // dump('does not exist');
            touch(self::$filePath);
            // mkdir(self::$filePath);
            die;
        } else {
            // dump('exist');
            // die;
        }
    }

    public static function write(string $message)
    {
        self::createFile();

        $file = fopen(self::$filePath, 'a+');

        $message = '[' . DateTime::date('H:i:s d-m-Y') . '] ' . $message;
        fwrite($file, $message . PHP_EOL);
        fclose($file);
    }
}
