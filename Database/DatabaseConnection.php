<?php
require_once('config/config.php');

class DatabaseConnection
{
    private $databaseType, $host, $databaseName, $username, $password, $connection;
    private static $instance;

    private function __construct($databaseType,  $host, $databaseName, $username, $password)
    {
        $this->databaseType        = $databaseType;
        $this->host                = $host;
        $this->databaseName        = $databaseName;
        $this->username            = $username;
        $this->password            = $password;
    }

    public static function getInstance($config = [])
    {
        if (!self::$instance) {
            if (count($config) > 0 && count($config) < 5) {
                $databaseType       = $config['databaseType'];
                $host               = $config['host'];
                $databaseName       = $config['databaseName'];
                $username           = $config['usename'];
                $password           = $config['password'];

                self::$instance     = new DatabaseConnection(
                    $databaseType,
                    $host,
                    $databaseName,
                    $username,
                    $password
                );
            } else {
                global $databaseType, $host, $databaseName, $username, $password;

                self::$instance = new DatabaseConnection(
                    $databaseType,
                    $host,
                    $databaseName,
                    $username,
                    $password
                );
            }
        }
        return self::$instance;
    }

    public function getConnection()
    {

        if (!$this->connection) {
            $dsn                = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";
            $this->connection   = new PDO($dsn, $this->username, $this->password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->connection;
    }
}
