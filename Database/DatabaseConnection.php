<?php
require_once "config/config.php";


class DatabaseCnnection
{
    private $connection;
    public function __construct()
    {
        global $databaseType, $databaseName, $username, $password;

        $dsn = "{$databaseType}:host=localhost;dbname={$databaseName}";
        // echo $dsn;
        $this->connection = new PDO($dsn, $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}


// try {
//     $msqli = mysqli_connect($host, $username, $password, $databaseName);
// } catch (\Throwable $th) {
//     echo 'cannot make connection';
// }
