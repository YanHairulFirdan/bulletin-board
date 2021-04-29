<?php
require_once('config/database_connection.php');
require_once('helpers/debug.php');

function create_pagination($limit = 10)
{
    global $msqli;

    $query = "SELECT COUNT(*) FROM bulletins";
    $result = mysqli_fetch_row(mysqli_query($msqli, $query));
    $numberOfRecords = $result[0];
    $numberOfButton = floor($numberOfRecords / $limit);
    $numberOfButton += (floor($numberOfRecords % $limit)) ? 1 : 0;

    return $numberOfButton;
}


function pagination()
{
    global $msqli;


    $numberOfButton = create_pagination();

    if (isset($_REQUEST['page']) && intval($_REQUEST['page']) > 1) {
        $page = intval($_REQUEST['page']);
        if ($page > $numberOfButton) {
            header('location:index.php');
        }
        $offset = ($page - 1) * 10;
        $query = "SELECT `title`, `created_at` FROM bulletins ORDER BY `created_at` DESC LIMIT 10  OFFSET {$offset} ";
    } elseif (!isset($_REQUEST['page']) || intval($_REQUEST['page']) == 1) {
        $query = "SELECT `title`, `created_at` FROM bulletins ORDER BY `created_at` DESC LIMIT 10 ";
    }

    $result = mysqli_query($msqli, $query);

    return [
        $result,
        $numberOfButton
    ];
}
