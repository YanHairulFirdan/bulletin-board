<?php

namespace Lib\Database;

class PostgresSQLAdapter extends AbstractConnection
{
    private function __construct(array $config)
    {
        parent::__construct($config);
    }

    public static function getInstance(array $config)
    {
        if (!self::$instance) {
            self::$instance = new PostgresSQLAdapter($config);
        }

        return self::$instance;
    }
}
