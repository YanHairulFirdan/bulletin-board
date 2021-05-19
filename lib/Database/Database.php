<?php

namespace Lib\Database;

use Exception;


class Database
{
    private $connectionInstance;
    private $connection;
    private $tableName;
    /*
        @var for returning error Message
     */
    private $errorMsg;


    public function __construct(string $tableName)
    {
        $this->tableName          = $tableName;
        $this->connectionInstance = ConnectionFactory::create();
    }

    public function setConnection()
    {
        if (!$this->connection) {
            $this->connectionInstance->connect();

            $this->connection = $this->connectionInstance->getConnection();
        }
    }

    public function setColumn(array $columns)
    {
        if (count($columns) > 0) {
            $columns      = implode(',', $columns);
            $this->query  = "SELECT {$columns} FROM {$this->tableName}";
        } elseif (gettype($columns) != 'array') {
            throw new Exception("Columns' value must be an array");
            return $this->errorMsg->getMessage();
        } else {
            throw new Exception("Columns' value mus be provide");
            return $this->errorMsg->getMessage();
        }
    }

    public function setWhereClause(string $column, string $operator = '=', mixed $value)
    {
        if (!is_null($column)) {
            if (!is_null($value) || isset($value)) {
                $subQuery = " WHERE {$column} {$operator} '{$value}'";
            }
            $this->query .= $subQuery;
        } else {
            throw new Exception("Columns' name must be provide");
            return $this->errorMsg->getMessage();
        }
    }

    public function setOrderBy(string $column, string $orderType = '')
    {
        if (!is_null($column)) {
            $subQuery = " ORDER BY {$column}";

            if (!is_null($orderType) || $orderType != '') {
                $subQuery .= " {$orderType}";
            }

            $this->query .= $subQuery;
        } else {
            throw new Exception("Columns' name must be provide");
            return $this->errorMsg->getMessage();
        }
    }

    public function setLimit(int $limit, int $offset = 0)
    {
        if ($limit > 0) {
            $subQuery     = " LIMIT {$limit}";
            if ($offset > 0) {
                $subQuery .= " OFFSET {$offset}";
            }
            $this->query .= $subQuery;
        } else {
            throw new Exception("Limit must be greater than 0");
            return $this->errorMsg->getMessage();
        }
    }

    public function setGroupBy(string $column)
    {
        if (!is_null($column)) {
            $subQuery     = " GROUP BY {$column}";
            $this->query .= $subQuery;
        } else {
            throw new Exception("Column's name must be provided");
            return $this->errorMsg->getMessage();
        }
    }

    public function select()
    {
        $this->setConnection();

        if (!empty($this->query)) {
            if (strpos($this->query, 'SELECT') === false) {
                $this->query = "SELECT * FROM {$this->tableName} {$this->query}";
            }
        } else {
            $this->query = "SELECT * FROM {$this->tableName}";
        }

        return $this->connection->query($this->query)->fetchAll();
    }
    // methods for insert data
    public function insert(array $data)
    {
        $this->setConnection();

        list($columns, $values) = $this->extractData($data);
        $this->query            = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$values})";
        $this->connection->query($this->query);
    }
    // methods for update data
    public function update(string $column, mixed $value, array $data)
    {
        $this->setConnection();

        $updateStatement = $this->updateQuery($data);
        $this->query     = "UPDATE $this->tableName SET  {$updateStatement} WHERE $column = {$value}";

        $this->connection->query($this->query);
    }

    // methods for delete data
    public function delete(string $column, mixed $value)
    {
        $this->setConnection();
        $this->query = "DELETE {$this->tableName} WHERE {$column} = {$value}";

        $this->connection->query($this->query);
    }

    public function numrows()
    {
        $this->setConnection();
        $this->query = "SELECT COUNT(*) FROM {$this->tableName}";
        $numRows     = $this->connection->query($this->query);

        return $numRows->fetchColumn();
    }

    private function updateQuery(array $data)
    {
        $updateStatement = '';
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
