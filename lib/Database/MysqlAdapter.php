<?php

namespace Lib\Database;

class MysqlAdapter extends AbstractConnection
{
    private function __construct(array $config)
    {
        parent::__construct($config);
    }

    public static function getInstance(array $config)
    {
        if (!self::$instance) {
            self::$instance = new MysqlAdapter($config);
        }

        return self::$instance;
    }
}
