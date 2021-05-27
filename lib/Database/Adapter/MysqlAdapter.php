<?php

namespace Lib\Database\Adapter;


class MysqlAdapter extends AbstractConnection
{
    private function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MysqlAdapter();
        }

        return self::$instance;
    }
}
