<?php

namespace Lib\Database\Adapters;

use PDO;

class SQLiteAdapter extends BaseAdapter implements DBAdapterInterface
{
    private $directory = '/database/database.db';

    private function __construct()
    {
        $this->directory    = DATABASE_DIRECTORY ?: $this->directory;
        $this->databaseName = DATABASE_NAME ?: $this->databaseName;
    }

    public function connect()
    {
        $this->dsn        = "{$this->databaseType}:/{$this->directory}/{$this->databaseName}.db";
        $this->connection = new PDO($this->dsn);

        $this->setPDOAttributes();

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
