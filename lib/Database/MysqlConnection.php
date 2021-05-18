<?php

namespace Lib\Database;

use PDO;

class MysqlConnection implements DatabaseConnectionInterface
{
    private $connection, $dsn, $databaseType, $host, $databaseName, $username, $password;
    private static $instance = null;
    private function __construct()
    {
        $this->databaseType = DATABASE_TYPE;
        $this->host         = HOST;
        $this->databaseName = DATABASE_NAME;
        $this->username     = USERNAME;
        $this->password     = PASSWORD;
    }
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MysqlConnection;
        }

        return self::$instance;
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
}
