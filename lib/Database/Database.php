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
     * The attribute for get database connection instance.
     *
     * @var Object
     */
    private $connectionInstance;
    /**
     * The attribute for get PDO instance.
     *
     * @var Object
     */
    private $connection;
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
     * @param string table name
     * for creating database instance and database connection instance
     */
    public function __construct(string $tableName)
    {
        $this->tableName          = $tableName;
        $this->connectionInstance = ConnectionFactory::create();
    }

    /** 
     * 
     * for get database connection
     * 
     */
    public function setConnection()
    {
        if (!$this->connection) {
            $this->connectionInstance->connect();

            $this->connection = $this->connectionInstance->getConnection();
        }
    }

    /**
     *  
     * @param array table name
     * for set column that will be select
     * 
     */
    public function setColumn(array $columns)
    {
        if (count($columns) > 0) {
            $columns      = implode(',', $columns);
            $this->query  = "SELECT {$columns} FROM {$this->tableName}";
        } elseif (gettype($columns) != 'array') {
            throw new Exception("Columns' value must be an array");
        } else {
            throw new Exception("Columns' value mus be provide");
        }
    }

    /**
     *  
     * @param string column, @param string operator, @param mixed value
     * for set where clause
     * 
     */
    public function setWhereClause(string $column, string $operator = '=', mixed $value)
    {
        if (!is_null($column)) {
            if (!is_null($value) || isset($value)) {
                $subQuery = " WHERE {$column} {$operator} '{$value}'";
            }
            $this->query .= $subQuery;
        } else {
            throw new Exception("Columns' name must be provide");
        }
    }

    /**
     *  
     * @param string column name, @param string orderby type
     * for set order by clause
     * 
     */
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
        }
    }

    /**
     *  
     * @param int limit, @param int offset
     * for set limit and offset of selected data
     * 
     */
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
        }
    }

    /**
     *  
     * @param string column name
     * for set group by clause
     * 
     */
    public function setGroupBy(string $column)
    {
        if (!is_null($column)) {
            $subQuery     = " GROUP BY {$column}";
            $this->query .= $subQuery;
        } else {
            throw new Exception("Column's name must be provided");
        }
    }

    /**
     *  
     * for select record
     * @return array of records
     */
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

    /**
     *  
     * @param array data
     * data is array associative that representate as column name and value
     * for insert data to table
     * 
     */
    public function insert(array $data)
    {
        $this->setConnection();

        list($columns, $values) = $this->extractData($data);
        $this->query            = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$values})";
        $this->connection->query($this->query);
    }


    /**
     *  
     * @param string column name, @param mixed value, @param array data(that will be use for updating record)
     * data is array associative that representate as column name and value
     * for update data to table
     * 
     */
    public function update(string $column, mixed $value, array $data)
    {
        $this->setConnection();

        $updateStatement = $this->updateQuery($data);
        $this->query     = "UPDATE $this->tableName SET  {$updateStatement} WHERE $column = {$value}";

        $this->connection->query($this->query);
    }

    /**
     *  
     * @param string column name, @param mixed value
     * value can be integer or string 
     * for delete data from table
     * 
     */
    public function delete(string $column, mixed $value)
    {
        $this->setConnection();
        $this->query = "DELETE {$this->tableName} WHERE {$column} = {$value}";

        $this->connection->query($this->query);
    }

    /**
     *  
     * for get number of records from a table
     * @return int number of record
     * 
     */
    public function numrows()
    {
        $this->setConnection();
        $this->query = "SELECT COUNT(*) FROM {$this->tableName}";
        $numRows     = $this->connection->query($this->query);

        return $numRows->fetchColumn();
    }
    /**
     *  
     * @param array data(that will be use for updating record)
     * data is array associative that representate as column name and value
     * for insert data to table
     * @return string as sub query for update record
     * 
     */
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

    /**
     *  
     * @param array data(that will be use for inserting record)
     * data is array associative that representate as column name and value
     * for insert data to table
     * @return string as sub query for insert record
     * 
     */
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
