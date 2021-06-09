<?php

namespace Lib\Database;

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
            $columns     = implode(',', $columns);
            $this->query = "SELECT {$columns} FROM {$this->tableName}";
        }
    }

    public function setWhereClause(string $column, string $operator = '=', $value)
    {
        if (!is_null($column)) {
            if (!is_null($value) || isset($value)) {
                $subQuery                     = " WHERE {$column} {$operator} :$column";
                $this->columnBind[":$column"] = $value;
                $this->query                 .= $subQuery;
            }
        }
    }

    public function setOrderBy(string $column, string $orderType = '')
    {
        if (!is_null($column)) {
            $subQuery     = " ORDER BY {$column} {$orderType}";
            $this->query .= $subQuery;
        }
    }

    public function setLimit(int $limit)
    {
        if ($limit > 0) {
            $this->limit  = $limit;
            $subQuery     = " LIMIT {$limit}";
            $this->query .= $subQuery;
        }
    }

    public function setOffset(int $offset)
    {
        if ($offset > 1) {
            $offset--;
            $offset      *= $this->limit;
            $subQuery     = " OFFSET {$offset}";
            $this->query .= $subQuery;
        }
    }

    public function setGroupBy(string $column)
    {
        if (!is_null($column)) {
            $subQuery     = " GROUP BY {$column}";
            $this->query .= $subQuery;
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

        $execute = $this->pdo->prepare($this->query);

        if ($this->columnBind) {
            foreach ($this->columnBind as $key => $value) {
                $execute->bindValue($key, $value);
            }
            $this->columnBind = [];
        }

        $execute->execute();

        $results      = $execute->fetchAll();
        $this->query  = '';

        return $results;
    }

    public function insert(array $dataInsert)
    {
        $this->setConnection();

        $insertSubquery = $this->extractData($dataInsert);
        $this->query    = "INSERT INTO {$this->tableName} {$insertSubquery}";
        $execute        = $this->pdo->prepare($this->query);

        foreach ($this->columnBind as $field => $value) {
            $execute->bindValue($field, $value);
        }

        $execute->execute();

        $this->columnBind = [];
        $this->query      = '';
    }

    public function update(string $column, $value, array $dataUpdate)
    {
        $this->setConnection();

        $updateStatement = $this->updateQuery($dataUpdate);
        $this->query     = "UPDATE $this->tableName SET {$updateStatement} WHERE {$column} = :{$column}";
        $execute         = $this->pdo->prepare($this->query);

        $execute->bindValue(":{$column}", $value);

        foreach ($this->columnBind as $field => $value) {
            $execute->bindValue($field, $value);
        }

        $updateResult     = $execute->execute();
        $this->columnBind = [];
        $this->query      = '';

        return $updateResult;
    }

    public function delete(string $column, $value)
    {
        $this->setConnection();

        $this->query = "DELETE FROM {$this->tableName} WHERE {$column} = :{$column}";
        $execute     = $this->pdo->prepare($this->query);

        $execute->bindValue(":{$column}", $value);

        $deleteResult = $execute->execute();

        return $deleteResult;
    }

    public function numrows()
    {
        $this->setConnection();

        $this->query = "SELECT COUNT(*) FROM {$this->tableName}";
        $execute     = $this->pdo->prepare($this->query);

        $execute->execute();

        $numRows     = $execute->fetchColumn();
        $this->query = '';

        return $numRows;
    }

    private function updateQuery(array $dataUpdate)
    {
        $updateSubquery = '';

        foreach ($dataUpdate as $field => $value) {
            $this->setColumnBind($field, $value);

            $updateSubquery               .=  "`$field` = :{$field} ,";
            $this->columnBind[":{$field}"] = $value;
        }

        $updateSubquery  = substr($updateSubquery, 0, -1);

        return $updateSubquery;
    }

    private function extractData(array $dataInsert)
    {
        $preparedValue = "(";
        $columns       = "(";

        foreach ($dataInsert as $key => $field) {
            $this->setColumnBind($key, $field);

            $preparedValue .= ":{$key},";
            $columns       .= $key . ',';
        }

        $columns        = substr($columns, 0, -1);
        $preparedValue  = substr($preparedValue, 0, -1);
        $preparedValue .= ")";
        $columns       .= ")";
        $insertSubquery =  "{$columns} VALUES {$preparedValue}";

        return $insertSubquery;
    }

    private function setColumnBind($field, $value)
    {
        $field                         = filter_var($field, FILTER_SANITIZE_STRING);
        $field                         = filter_var($field, FILTER_SANITIZE_STRING);
        $this->columnBind[":{$field}"] = $value;
    }
}
