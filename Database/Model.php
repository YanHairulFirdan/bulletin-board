<?php

namespace App\Databases;

use Lib\Database\Database;
use Lib\Database\MysqlConnection;


abstract class Model
{
    protected $tableName;
    private $database;

    public function __construct()
    {
        $this->database = new Database(new MysqlConnection);
    }

    public function get()
    {
        return $this->database->select($this->tableName);
    }

    public function limit($limit)
    {
        $this->database->limit = $limit;

        return $this;
    }


    public function paginate($limit)
    {
        $this->database->limit = $limit;

        if (isset($_GET['page'])) {
            if (intval($_GET['page']) > 1) {
                $offset                 = (intval($_GET['page']) - 1) * 10;
                $this->database->offset = $offset;
            }
        }

        return $this->database->select($this->tableName);
    }

    public function columns(string $columns)
    {
        $this->database->columns = $columns;

        return $this;
    }

    public function numRows()
    {
        return $this->database->numrows($this->tableName);
    }

    public function orderBy($column, $orderType = '')
    {
        $this->database->orderBy = $column;

        if ($orderType != '') {
            $this->database->orderType = $orderType;
        }

        return $this;
    }

    public function where($column, $operator = "=", $value)
    {
        $this->database->where      = $column;
        $this->database->operator   = $operator;
        $this->database->whereValue = $value;

        return $this;
    }

    public function create(array $data)
    {
        $this->database->insert($data, $this->tableName);
    }
}
