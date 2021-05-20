<?php

namespace Lib\Database;

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

    public function __construct(array $config)
    {
        // config = include 'config/database.php';
        dump($_SERVER);
        // die;
        dump(require_once 'config/database.php');
        // dump(include $_SERVER['DOCUMENT_ROOT'] . '/BulletinBoard/config/database.php');
        $this->databaseType = check_value('databaseType', DATABASE_TYPE, $config);
        $this->host         = check_value('host', HOST, $config);
        $this->databaseName = check_value('databaseName', DATABASE_NAME, $config);
        $this->username     = check_value('username', USERNAME, $config);
        $this->password     = check_value('password', PASSWORD, $config);
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

    public abstract static function getInstance(array $config);
}
