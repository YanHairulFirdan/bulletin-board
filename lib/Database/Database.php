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

    public function setColumn()
    {
        if (!is_null($this->columns)) {
            $this->query = str_replace('*', $this->columns, $this->query);
        }
    }

    public function setWhereClause()
    {
        if (!is_null($this->where)) {
            $subQuery     = " WHERE {$this->where} {$this->operator} '{$this->whereValue}'";
            $this->query .= $subQuery;
        }
    }

    public function setOrderBy()
    {
        if (!is_null($this->orderBy)) {
            $subQuery = " ORDER BY {$this->orderBy}";

            if (!is_null($this->orderType)) {
                $subQuery .= " {$this->orderType}";
            }

            $this->query .= $subQuery;
        }
    }

    public function setLimit()
    {
        if ($this->limit > 0) {
            $subQuery     = " LIMIT {$this->limit}";
            $this->query .= $subQuery;

            if (!is_null($this->offset)) {
                $this->query .= " OFFSET {$this->offset}";
            }
        }
    }

    public function setGroupBy()
    {
        if (!is_null($this->groupBy)) {
            $subQuery     = " GROUP BY {$this->groupBy}";
            $this->query .= $subQuery;
        }
    }

    public function select($tablename)
    {

        $this->setConnection();
        $this->query = "SELECT * FROM {$tablename}";
        $this->setColumn();
        $this->setWhereClause();
        $this->setOrderBy();
        $this->setLimit();
        $this->setGroupBy();

        return $this->connection->query($this->query)->fetchAll();
    }
    // methods for insert data
    public function insert($data, $tableName)
    {
        $this->setConnection();
        $this->tableName        = $tableName;
        list($columns, $values) = $this->extractData($data);
        $this->query            = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$values})";
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

    public function numrows($tableName)
    {
        $this->setConnection();
        $this->query = "SELECT COUNT(*) FROM {$tableName}";
        $numRows     = $this->connection->query($this->query);

        return $numRows->fetchColumn();
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
