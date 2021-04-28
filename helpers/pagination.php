<?php
require_once('config/database_connection.php');
require_once('helpers/debug.php');

function create_pagination($limit = 10)
{
    global $msqli;
    $query = "SELECT COUNT(*) FROM bulletins";
    $result = mysqli_fetch_row(mysqli_query($msqli, $query));
    // print_debug($result);
    $numberOfRecords = $result[0];

    $numberOfButton = floor($numberOfRecords / $limit);
    $numberOfButton += (floor($numberOfRecords % $limit)) ? 1 : 0;


    return $numberOfButton;
}


function pagination()
{
    global $msqli;
    $limit = 10;
    $numberOfButton = create_pagination();



    if (isset($_REQUEST['page']) && intval($_REQUEST['page']) > 1) {
        $page = intval($_REQUEST['page']);
        $offset = ($page - 1) * $limit;
        $query = "SELECT `title`, `created_at` FROM bulletins ORDER BY `created_at` DESC LIMIT {$limit}  OFFSET {$offset} ";
    } elseif (!isset($_REQUEST['page']) || intval($_REQUEST['page']) == 1) {
        $query = "SELECT `title`, `created_at` FROM bulletins ORDER BY `created_at` DESC LIMIT {$limit} ";
    }

    $result = mysqli_query($msqli, $query);
    // print_debug($query);
    // print_debug(mysqli_num_rows($result));
    // die;

    return [
        $result,
        $numberOfButton
    ];
}

// pagination();
