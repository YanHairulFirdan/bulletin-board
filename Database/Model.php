<?php
require_once 'vendor/autoload.php';
// require_once 'helpers/file_manipulation.php';
require_once 'config/config.php';
require_once('Database/DatabaseConnection.php');

class Model
{
    private $tableName;
    private $databaseConnection;
    private $databaseInstance;
    public $dataPerPage;

    public function __construct(DatabaseConnection $databaseConnection, $tableName, $dataPerPage = 10)
    {
        $this->tableName            = $tableName;
        $this->databaseConnection   = $databaseConnection;
        $this->dataPerPage          = $dataPerPage;
    }


    public function getData()
    {
        $this->setConnection();

        if (isset($_REQUEST['page']) && intval($_REQUEST['page']) > 1) {
            $offset     = (intval($_REQUEST['page']) - 1) * 10;
            $query      = "SELECT * FROM {$this->tableName} ORDER BY created_at DESC LIMIT {$this->dataPerPage}, {$offset}";
        } else {
            $query      = "SELECT * FROM {$this->tableName} ORDER BY created_at DESC LIMIT {$this->dataPerPage}";
        }

        $data = $this->databaseInstance->query($query);
        $this->numberOfRecord();
        return $data;
    }

    public function create($data)
    {
        $this->setConnection();

        list($columns, $values)     = $this->extractData($data);
        $columns                    =  substr($columns, 0, -1);
        $values                     =  substr($values, 0, -1);
        $query                      = "INSERT INTO $this->tableName ({$columns}) VALUES ({$values})";

        $this->databaseInstance->query($query);
        header('location:index.php');
    }




    public function numberOfRecord()
    {
        $this->setConnection();

        $query              = "SELECT COUNT(*) FROM {$this->tableName}";
        $numberOfRecords    = $this->databaseInstance->query($query);

        return $numberOfRecords->fetchColumn();
    }

    private function setConnection()
    {
        if (!$this->databaseInstance) {
            $this->databaseInstance     = $this->databaseConnection->getConnection();
        }
    }

    private function extractData($data)
    {
        $columns        = $values = "";

        foreach ($data as $key => $field) {
            $key        = htmlspecialchars($key);
            $field      = htmlspecialchars($field);
            $columns   .= '`' . $key . '`' . ',';
            $values    .= "'$field'" . ',';
        }

        return [$columns, $values];
    }
}
