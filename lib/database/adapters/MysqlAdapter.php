<?php

namespace Lib\Database\Adapters;

use PDO;

class MysqlAdapter extends BaseAdapter implements DBAdapterInterface
{
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MysqlAdapter();
        }

        return self::$instance;
    }
}
