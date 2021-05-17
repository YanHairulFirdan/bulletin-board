<?php

use Lib\Database\DatabaseConnectionInterface;

class Database
{
    private $connection;

    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }
    private $column, $offset, $limit, $query;
    public function select()
    {
        $this->query = "SELECT * FROM TABLE";
    }
    // methods for insert data
    public function insert($data)
    {
    }
    // methods for update data
    public function update($data)
    {
    }
    // methods for delete data
    public function delete()
    {
    }
}
