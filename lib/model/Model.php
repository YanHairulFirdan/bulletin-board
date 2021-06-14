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
        return $this->database->select()->execute();
    }

    public function create(array $data)
    {
        $this->database->insert($data)->execute();
    }

    public function findByID($id)
    {
        $this->database->setWhereClause('id', '=', $id);
        $record = $this->database->select()->execute();

        return $record;
    }

    public function update(array $dataEdit, $columnn, $value)
    {
        $this->database->setWhereClause($columnn, '=', $value);
        $this->database->update($dataEdit)->execute();
    }

    public function delete(string $column, $value)
    {
        $this->database->delete($column, $value)->execute();
    }

    public function numRows()
    {
        $numRows = $this->database->numrows()->execute();

        return $numRows[0][0];
    }

    public function limit(int $limit)
    {
        $this->database->setLimit($limit);

        return $this;
    }

    public function columns(...$columns)
    {
        $this->database->setColumn($columns);

        return $this;
    }

    public function orderBy(string $column, string $orderType = 'ASC')
    {
        $this->database->setOrderBy($column, $orderType);

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

        return $this;
    }
}
