<?php

namespace Lib\Database;


class PosgresConnection extends DatabaseConnectionAbstract
{
    private function __construct(array $config)
    {
        parent::__construct($config);
    }
    public static function getInstance(array $config)
    {
        if (!self::$instance) {
            self::$instance = new PosgresConnection($config);
        }

        return self::$instance;
    }
}
