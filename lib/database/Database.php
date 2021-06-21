<?php

namespace Lib\Database;

use Lib\Utils\Logger;

/*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    |
    | This database class use for querying data like select, insert delete and update
    | it also provide some function to break data that will be used for insert and update
    |
    */

class Database
{
    /**
     * The attribute for get database connection class.
     *
     * @var Object
     */
    private $dbAdapter;

    /**
     * The attribute for get database connection.
     *
     * @var Object
     */

    private $pdo;

    /**
     * The attribute for get table name.
     *
     * @var string
     */
    private $tableName;
    /**
     * The attribute for store query string.
     *
     * @var string
     */
    private $query;

    /** 
     * @param mixed column bind
     * for using pdo bindValue()
    
     */
    private $columnBind;
    private $limit;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->dbAdapter = ConnectionFactory::create(DATABASE_TYPE);
    }

    public function setConnection()
    {
        if (!$this->pdo) {
            $this->pdo = $this->dbAdapter->connect();
        }
    }

    public function setColumn(array $columns)
    {
        if (count($columns) > 0) {
            $columns = implode(',', $columns);

            $this->query = "SELECT {$columns} FROM {$this->tableName}";
        }
    }

    public function setWhereClause(string $column, string $operator = '=', $value)
    {
        if (!empty($column)) {
            if (!empty($value)) {
                $subQuery = " WHERE {$column} {$operator} :$column";

                $this->query .= $subQuery;
                $this->setColumnBind($column, $value);
            }
        }
    }

    public function setOrderBy(string $column, string $orderType = 'ASC')
    {
        if (!is_null($column)) {
            $subQuery = " ORDER BY {$column} {$orderType}";

            $this->query .= $subQuery;
        }
    }

    public function setLimit(int $limit)
    {
        if ($limit > 0) {
            $this->limit = $limit;

            $subQuery = " LIMIT {$limit}";

            $this->query .= $subQuery;
        }
    }

    public function setOffset(int $offset)
    {
        if ($offset > 1) {
            $offset--;
            $offset  *= $this->limit;
            $subQuery = " OFFSET {$offset}";

            $this->query .= $subQuery;
        }
    }

    public function setGroupBy(string $column)
    {
        if (!empty($column)) {
            $subQuery = " GROUP BY {$column}";

            $this->query .= $subQuery;
        }

        return $this;
    }

    public function select()
    {
        if (!empty($this->query)) {
            if (strpos($this->query, 'SELECT') === false) {
                $this->query = "SELECT * FROM {$this->tableName} {$this->query}";
            }
        } else {
            $this->query = "SELECT * FROM {$this->tableName}";
        }

        return $this;
    }

    public function insert(array $dataInsert)
    {
        $insertSubquery = $this->createInsertQuery($dataInsert);

        $this->query = "INSERT INTO {$this->tableName} {$insertSubquery}";

        foreach ($dataInsert as $column => $value) {
            $this->setColumnBind($column, $value);
        }

        return $this;
    }

    public function update(array $dataUpdate)
    {
        $updateStatement = $this->updateQuery($dataUpdate);

        $this->query = "UPDATE $this->tableName SET {$updateStatement} {$this->query}";

        foreach ($dataUpdate as $column => $value) {
            $this->setColumnBind($column, $value);
        }

        return $this;
    }

    public function delete(string $column, $value)
    {
        $this->query = "DELETE FROM {$this->tableName} WHERE {$column} = :{$column}";
        $this->setColumnBind($column, $value);
        return $this;
    }

    public function numrows()
    {
        $this->query = "SELECT COUNT(*) FROM {$this->tableName}";

        return $this;
    }

    private function updateQuery(array $dataUpdate)
    {
        $updateSubquery = '';

        foreach ($dataUpdate as $column => $value) {
            $updateSubquery .=  "`$column` = :{$column} ,";
        }

        $updateSubquery = substr($updateSubquery, 0, -1);

        return $updateSubquery;
    }

    private function createInsertQuery(array $dataInsert)
    {
        $columnList = array_keys($dataInsert);

        array_unshift($columnList, '');

        $columns        = '(' . ltrim(implode(',', $columnList), ',') . ')';
        $preparedValue  = '(' . ltrim(implode(',:', $columnList), ',') . ')';
        $insertSubquery = "{$columns} VALUES {$preparedValue}";

        return $insertSubquery;
    }

    public function execute()
    {
        $this->setConnection();

        $prepare = $this->pdo->prepare($this->query);

        if ($this->columnBind) {
            foreach ($this->columnBind as $key => $value) {
                $prepare->bindValue($key, $value);
            }

            $this->columnBind = [];
        }

        $prepare->execute();

        $this->query = '';

        return $prepare->fetchAll();
    }

    private function setColumnBind($field, $value)
    {
        $field = filter_var($field, FILTER_SANITIZE_STRING);
        $value = filter_var($value, FILTER_SANITIZE_STRING);

        $this->columnBind[":{$field}"] = $value;
    }
}
