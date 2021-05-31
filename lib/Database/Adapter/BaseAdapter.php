<?php

namespace Lib\Database\Adapter;

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

    public function __construct()
    {
        $configs            = db_default_config();
        $this->databaseType = $configs['type'];
        $this->host         = $configs['config'][$this->databaseType]['host'];
        $this->databaseName = $configs['config'][$this->databaseType]['databaseName'];
        $this->username     = $configs['config'][$this->databaseType]['username'];
        $this->password     = $configs['config'][$this->databaseType]['password'];
    }
}
