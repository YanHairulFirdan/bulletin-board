<?php

namespace Lib\Database;

class PostgresSQLAdapter extends AbstractConnection
{
    private function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PostgresSQLAdapter();
        }

        return self::$instance;
    }
}
