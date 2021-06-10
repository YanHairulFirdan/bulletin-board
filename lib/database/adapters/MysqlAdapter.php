<?php

namespace Lib\Database\Adapters;

use PDO;

class MysqlAdapter extends BaseAdapter implements DBAdapterInterface
{
    public function connect()
    {
        $this->dsn        = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";
        $this->connection = new PDO($this->dsn, $this->username, $this->password);

        $this->setPDOAttributes();

        return $this->connection;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MysqlAdapter();
        }

        return self::$instance;
    }
}
