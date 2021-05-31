<?php

namespace Lib\Database\Adapter;

use PDO;

class PostgresSQLAdapter extends BaseAdapter implements DBAdapterInterface
{
    private $connection;
    private $dsn;
    private $databaseType;
    private $host;
    private $databaseName;
    private $username;
    private $password;
    private static $instance = null;

    private function __construct()
    {
        parent::__construct();
    }

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
            self::$instance = new PostgresSQLAdapter();
        }

        return self::$instance;
    }
}
