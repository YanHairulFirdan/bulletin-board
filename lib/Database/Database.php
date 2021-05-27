<?php

namespace Lib\Database;

use Exception;

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
     * The attribute for get database connection.
     *
     * @var Object
     */
    private $queryBuilder;

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
     * @param mixed column value
     * for creating database instance and database connection instance
     */
    private $columnValue;
    /** 
     * @param mixed column name
     * for creating database instance and database connection instance
    
     */
    private $columnBind;
    /** 
     * @param array column name
     * for creating database instance and database connection instance
    
     */
    private $columnName;

    public function __construct(string $tableName)
    {
        $this->tableName    = $tableName;
        $this->dbAdapter    = ConnectionFactory::create(config("DATABASE_TYPE", 'mysql'));
        $this->queryBuilder = new QueryBuilder();
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
            $subQuery = " ORDER BY {$column}";

            if (!is_null($orderType) || $orderType != '') {
                $subQuery .= " {$orderType}";
            }

            $this->query .= $subQuery;
        }
    }

    public function setLimit(int $limit, int $offset = 0)
    {
        if ($limit > 0) {
            $subQuery = " LIMIT {$limit}";
            if ($offset > 0) {
                $subQuery .= " OFFSET {$offset}";
            }
            $this->query .= $subQuery;
        }
    }

    public function setOffset(int $offset)
    {
        if ($offset > 0) {
            $subQuery = " OFFSET {$offset}";
        }

        $this->query .= $subQuery;
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

        $execute     = $this->pdo->prepare($this->query);

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

    public function insert(array $data)
    {
        $this->setConnection();

        list($columns, $values, $preparedValue) = $this->extractData($data);
        $this->query                            = "INSERT INTO {$this->tableName} {$columns} VALUES {$preparedValue}";
        $execute                                = $this->pdo->prepare($this->query);

        try {
            $this->pdo->query($this->query);
        } catch (Exception $exception) {
            $exception->getMessage();
        }

        $execute->execute($values);
    }

    public function update(string $column, $value, array $data)
    {
        $this->setConnection();

        list($updateStatement, $values) = $this->updateQuery($data);
        $this->query                    = "UPDATE $this->tableName SET{$updateStatement} WHERE {$column} = ?";
        $execute                        = $this->pdo->prepare($this->query);

        $execute->execute([...$values, $value]);
    }

    public function delete(string $column, $value)
    {
        $this->setConnection();

        $this->query = "DELETE {$this->tableName} WHERE {$column} = (?)";
        $execute     = $this->pdo->prepare($this->query);

        $execute->execute([$value]);
    }

    public function numrows()
    {
        $this->setConnection();

        $this->query = "SELECT COUNT(*) FROM {$this->tableName}";
        $execute     = $this->pdo->prepare($this->query);

        $execute->execute();

        $numRows     = $execute->fetchColumn();

        return $numRows;
    }

    private function updateQuery(array $data)
    {
        $updateStatement = '(';
        $values          = [];
        foreach ($data as $key => $field) {
            $key              = htmlspecialchars($key);
            $field            = htmlspecialchars($field);
            $updateStatement .= '`' . "$key = ?"  . '`' . ',';
            $values[]         = $field;
        }

        $updateStatement = substr($updateStatement, 0, -1);
        $updateStatement .= ')';

        return [$updateStatement, $values];
    }

    private function extractData(array $data)
    {
        $preparedValue = "(";
        $columns       = "(";
        $values        = [];

        foreach ($data as $key => $field) {
            $key            = htmlspecialchars($key);
            $field          = htmlspecialchars($field);
            $preparedValue .= '?,';
            $columns       .= $key . ',';
            $values[]       = $field;
        }

        $columns        = substr($columns, 0, -1);
        $preparedValue  = substr($preparedValue, 0, -1);
        $preparedValue .= ")";
        $columns       .= ")";

        return [$columns, $values, $preparedValue];
    }
}
