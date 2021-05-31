<?php

namespace Lib\Database\Adapter;

use PDO;

abstract class BaseAdapter
{
    protected $connection;
    protected $dsn;
    protected $databaseType;
    protected $host;
    protected $databaseName;
    protected $username;
    protected $password;
    protected static $instance = null;

    protected function __construct()
    {
        $configs            = db_default_config();
        $this->databaseType = $configs['type'];
        $this->host         = $configs['config'][$this->databaseType]['host'];
        $this->databaseName = $configs['config'][$this->databaseType]['databaseName'];
        $this->username     = $configs['config'][$this->databaseType]['username'];
        $this->password     = $configs['config'][$this->databaseType]['password'];
    }

    protected function setPDOAttributes()
    {
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
}
