<?php

namespace Lib\Database;

use Lib\Database\DatabaseConnectionInterface;

class Database
{
    private $connectionInstance, $connection;
    public $columns;
    public $offset;
    public $limit;
    public $query;
    public $orderBy;
    public $orderType;
    public $where;
    public $column;
    public $operator;
    public $whereValue;
    public $groupBy;
    public $tableName;



    public function __construct(DatabaseConnectionInterface $connectionInstance)
    {
        $this->connectionInstance = $connectionInstance;
    }

    public function setConnection()
    {
        if (!$this->connection) {
            $this->connectionInstance->connect();
            $this->connection = $this->connectionInstance->getConnection();
        }
    }

    public function select($tablename)
    {
        $this->setConnection();
        $this->query = "SELECT * FROM {$tablename}";

        if (isset($this->columns)) {
            $this->query = str_replace('*', $this->columns, $this->query);
        }

        if (isset($this->limit)) {
            $subQuery     = " LIMIT {$this->limit}";
            $this->query .= $subQuery;
            if (isset($this->offset)) {
                $this->query .= " OFFSET {$this->offset}";
            }
        }

        if (isset($this->where)) {
            $subQuery     = " WHERE {$this->where} {$this->operator} {$this->whereValue}";
            $this->query .= $subQuery;
        }

        if (isset($this->orderBy)) {
            $subQuery = " ORDER BY {$this->orderBy}";

            if (isset($this->orderType)) {
                $subQuery .= " {$this->orderType}";
            }

            $this->query .= $subQuery;
        }

        if (isset($this->groupBy)) {
            $subQuery     = " GROUP BY {$this->groupBy}";
            $this->query .= $subQuery;
        }

        $this->connection->query($this->query);
    }
    // methods for insert data
    public function insert($data)
    {
        $this->setConnection();
        list($columns, $values) = $this->extractData($data);
        $this->query            = "INSERT INTO $this->tableName ({$columns}) VALUES ({$values})";

        $this->connection->query($this->query);
    }
    // methods for update data
    public function update($column, $value, $data)
    {
        $this->setConnection();
        $updateStatement = $this->updateQuery($data);
        $this->query     = "UPDATE $this->tableName SET  {$updateStatement} WHERE $column = {$value}";

        $this->connection->query($this->query);
    }

    // methods for delete data
    public function delete($column, $value)
    {
        $this->setConnection();
        $this->query = "DELETE {$this->tableName} WHERE {$column} = {$value}";

        $this->connection->query($this->query);
    }

    private function updateQuery(array $data)
    {
        $updateStatement = '';
        //                title => 'bla bla bla
        foreach ($data as $key => $field) {
            $key              = htmlspecialchars($key);
            $field            = htmlspecialchars($field);
            $updateStatement .= '`' . "$key = $field"  . '`' . ',';
        }

        $updateStatement = substr($updateStatement, 0, -1);

        return $updateStatement;
    }
    private function extractData(array $data)
    {
        $columns = "";
        $values  = "";

        foreach ($data as $key => $field) {
            $key      = htmlspecialchars($key);
            $field    = htmlspecialchars($field);
            $columns .= '`' . $key . '`' . ',';
            $values  .= "'$field'" . ',';
        }
        $columns = substr($columns, 0, -1);
        $values  = substr($values, 0, -1);

        return [$columns, $values];
    }
}
