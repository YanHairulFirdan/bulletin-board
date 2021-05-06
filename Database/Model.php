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
    private $dataPerPage;

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




    private function numberOfRecord()
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

    public function pagination()
    {
        $numberOfRecords         = $this->numberOfRecord();
        $numberOfPager           = floor($numberOfRecords / $this->dataPerPage);
        $numberOfPager          += ($numberOfRecords % $this->dataPerPage > 0) ? 1 : 0;
        $currentPage             = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
        $nextPage                = ($currentPage != $numberOfPager) ? $currentPage + 1 : 0;
        $previousPage            = ($currentPage > 1) ? $currentPage -  1 : 0;
        $pager                   = 5;

        if ($numberOfPager <= 5) {
            $startIndex     = 1;
            $pager          = $numberOfPager;
        } else if ($numberOfPager > 5) {
            $difference     = $numberOfPager - $pager;
            $startIndex     = ($currentPage < $difference + 1) ? $currentPage : $difference + 1;
            $pagerButton    = $startIndex + $pager;

            if ($startIndex == 5) {
                $startIndex     = 3;
                $pagerButton    = 8;
            }
        }

        return [
            $currentPage, $startIndex, $previousPage, $nextPage, $pagerButton
        ];
        // echo '<div class="pagination" style="margin: 3em auto; width: 80%; display: flex; justify-content: space-between;">';
        // if ($previousPage) {
        //     echo '<span class="btn-page">';
        //     echo "<a href='?page='" . $previousPage . ">&lt;</a>";
        //     echo "</span>";
        // }
        // for ($page = $startIndex; $page < $pagerButton; $page++) {
        //     if (($currentPage == $page)) {
        //         echo '<span class="btn-page">';
        //         echo "<span>" . $currentPage . "</span>";
        //         echo '</span>';
        //     } else {
        //         echo '<span class="btn-page">';
        //         echo "<a href=" . "?page=" . $page . ">" . $page . '</a>';
        //         echo '</span>';
        //     }
        // }

        // if ($nextPage) {
        //     echo '<span class="btn-page">';
        //     echo "<a href=" . "?page=" . $nextPage . ">&gt</a>";
        //     echo "</span>";
        // }
        // echo '</div>';
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
