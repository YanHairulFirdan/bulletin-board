<?php

namespace Lib\Database\Adapter;

use PDO;

abstract class BaseAdapter
{
    protected $connection;
    protected $dsn;
    protected $databaseType    = 'mysql';
    protected $host            = 'localhost';
    protected $databaseName    = 'bulletin';
    protected $username        = 'root';
    protected $password        = '';
    protected static $instance = null;

    protected function __construct()
    {
        $this->databaseType = DATABASE_TYPE ?: $this->databaseType;
        $this->host         = HOST ?: $this->host;
        $this->databaseName = DATABASE_NAME ?: $this->databaseName;
        $this->username     = USERNAME ?: $this->username;
        $this->password     = PASSWORD ?: $this->password;
    }

    protected function setPDOAttributes()
    {
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
}
