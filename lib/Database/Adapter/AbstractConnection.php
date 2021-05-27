<?php

namespace Lib\Database\Adapter;

use PDO;

abstract class AbstractConnection
{
    protected $connection;
    protected $dsn;
    protected $databaseType;
    protected $host;
    protected $databaseName;
    protected $username;
    protected $password;
    protected static $instance = null;

    public function __construct()
    {

        $configs            = db_default_config();
        $this->databaseType = $configs['dbType'];
        $this->host         = $configs['db_configs'][$this->databaseType]['host'];
        $this->databaseName = $configs['db_configs'][$this->databaseType]['databaseName'];
        $this->username     = $configs['db_configs'][$this->databaseType]['username'];
        $this->password     = $configs['db_configs'][$this->databaseType]['password'];
    }

    public function connect()
    {
        $this->dsn        = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";
        $this->connection = new PDO($this->dsn, $this->username, $this->password);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->connection;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public abstract static function getInstance();
}
