<?php
// require_once('config/config.php');

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
        if (!empty($config)) {
            $databaseType       = $config['databaseType'];
            $host               = $config['host'];
            $databaseName       = $config['databaseName'];
            $username           = $config['username'];
            $password           = $config['password'];

            self::$instance     = new DatabaseConnection(
                $databaseType,
                $host,
                $databaseName,
                $username,
                $password
            );

            return self::$instance;
        }
        if (!self::$instance) {

            global $databaseType, $host, $databaseName, $username, $password;

            self::$instance = new DatabaseConnection(
                $databaseType,
                $host,
                $databaseName,
                $username,
                $password
            );
        }
        return self::$instance;
    }

    public function getConnection()
    {

        if (!$this->connection) {
            $dsn              = "{$this->databaseType}:host={$this->host};dbname={$this->databaseName}";
            $this->connection = new PDO($dsn, $this->username, $this->password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $data = $this->connection->query('select');

            $data->fetchAll(PDO::FETCH_KEY_PAIR);
        }

        return $this->connection;
    }
}
