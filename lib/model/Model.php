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
        try {
            dump($this->database->insert($data)->execute());
        } catch (\Throwable $th) {
            dump($th->getMessage());
            die;
        }
    }

    public function findByID($id)
    {
        // $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT)`;

        $record = $this->database->select()->setWhereClause('id', '=', $id)->execute();

        return $record;
    }

    public function limit(int $limit)
    {
        $this->database->setLimit($limit);

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

    public function edit(string $column, $columnValue, array $dataEdit)
    {
        $this->database->update($dataEdit);

        return $this;
    }

    public function delete(string $column, $value)
    {
        $this->database->delete($column, $value);
    }
}
