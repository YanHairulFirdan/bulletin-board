<?php

namespace Lib\Database;


class MysqlConnection extends DatabaseConnectionAbstract
{
    private function __construct(array $config)
    {
        parent::__construct($config);
    }
    public static function getInstance(array $config)
    {
        if (!self::$instance) {
            self::$instance = new MysqlConnection($config);
        }

        return self::$instance;
    }
}
