<?php
require_once "config/config.php";


class DatabaseConnection
{
    private $databaseType, $host, $databaseName, $username, $password;

    public function __construct($databaseType,  $host, $databaseName, $username, $password)
    {
        $this->databaseType        = $databaseType;
        $this->host                = $host;
        $this->databaseName        = $databaseName;
        $this->username            = $username;
        $this->password            = $password;
    }

    public function getConnection()
    {
        $dsn                = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";

        $this->connection   = new PDO($dsn, $this->username, $this->password);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->connection;
    }
}
