<?php

namespace Lib\Database\Adapter;

use PDO;

class MysqlAdapter implements DBAdapterInterface
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
        $configs            = db_default_config();
        $this->databaseType = $configs['type'];
        $this->host         = $configs['config'][$this->databaseType]['host'];
        $this->databaseName = $configs['config'][$this->databaseType]['databaseName'];
        $this->username     = $configs['config'][$this->databaseType]['username'];
        $this->password     = $configs['config'][$this->databaseType]['password'];
    }

    public function connect()
    {
        $this->dsn        = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";
        $this->connection = new PDO($this->dsn, $this->username, $this->password);

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
