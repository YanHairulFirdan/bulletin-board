<?php

namespace Lib\Database;

require_once '../vendor/autoload.php';
// include('IDatabaseConnection.php');

use PDO;


// use IDatabaseConection;

class MysqlConnection implements DatabaseConnectionInterface
{
    private $connection, $dsn, $databaseType, $host, $databaseName, $username, $password;
    public function __construct()
    {
        $this->databaseType = DATABASE_TYPE;
        $this->host         = HOST;
        $this->databaseName = DATABASE_NAME;
        $this->username     = USERNAME;
        $this->password     = PASSWORD;
    }
    public function connect()
    {
        $this->dsn        = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";

        $this->connection = new PDO($this->dsn, $this->username, $this->password);
        echo 'connection has been created succesfully';


        return $this->connection;
    }
}
