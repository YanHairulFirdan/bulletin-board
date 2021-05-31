<?php

namespace Lib\Database\Adapter;

use PDO;

class SQLiteAdapter extends BaseAdapter implements DBAdapterInterface
{
    private $directory;

    private function __construct()
    {
        $configs            = db_default_config();
        $this->directory    = $configs['db_configs'][$this->databaseType]['directory'];
        $this->databaseName = $configs['db_configs'][$this->databaseType]['databaseName'];
    }

    public function connect()
    {
        $this->dsn        = "{$this->databaseType}:/{$this->directory}/{$this->databaseName}.db";
        $this->connection = new PDO($this->dsn);

        return $this->connection;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SQLiteAdapter();
        }

        return self::$instance;
    }
}
