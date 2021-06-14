<?php

namespace Lib\Database\Adapters;

use PDO;

class PostgresSQLAdapter extends BaseAdapter implements DBAdapterInterface
{
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PostgresSQLAdapter();
        }

        return self::$instance;
    }
}
