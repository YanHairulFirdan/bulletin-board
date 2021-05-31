<?php

namespace Lib\Model;

use Lib\Database\Database;

abstract class Model
{
    protected $tableName;
    private $database;

    public function __construct()
    {
        $this->database = new Database($this->tableName);
    }

    public function get()
    {
        $records = $this->database->select();

        return $records;
    }

    public function create(array $data)
    {
        $this->database->insert($data);
    }

    public function findByID($id)
    {
        $this->database->setWhereClause('id', '=', $id);

        $record = $this->database->select();

        return $record;
    }

    public function limit(int $limit)
    {
        $this->database->setLimit($limit);

        $getParam = get_request();

        if ($getParam && is_numeric($getParam)) {
            $getParam--;
            $getParam *= $limit;
            $this->offset($getParam);
        }

        return $this;
    }

    public function columns(array $columns)
    {
        $this->database->setColumn($columns);

        return $this;
    }

    public function numRows()
    {
        return $this->database->numrows();
    }

    public function orderBy(string $column, string $orderType = '')
    {
        if ($orderType != '') {
            $this->database->setOrderBy($column, $orderType);
            return $this;
        }

        $this->database->setOrderBy($column);

        return $this;
    }

    public function where(string $column, string $operator = "=", $value)
    {
        $this->database->setWhereClause($column, $operator, $value);

        return $this;
    }

    public function groupBy(string $column)
    {
        $this->database->setGroupBy($column);

        return $this;
    }

    public function offset(int $offset)
    {
        $this->database->setOffset($offset);
    }

    public function edit(string $column, $columnValue, array $dataEdit)
    {
        $this->database->update($column, $columnValue, $dataEdit);
    }

    public function delete(string $column, $value)
    {
        $this->database->delete($column, $value);
    }
}
