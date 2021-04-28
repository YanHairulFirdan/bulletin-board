<?php
session_start();
require_once('config/database_connection.php');
require_once('helpers/debug.php');

$errorMessage = [];

function validation($fields)
{
    // print_debug($fields);
    $rules = [
        'title' => [
            'min' => 10,
            'max' => 32
        ],
        'body' => [
            'min' => 10,
            'max' => 200
        ],
    ];



    foreach ($fields as $key => $field) {
        if (strlen($field) == 0) {
            $_SESSION[$key] = "($key) must be fill in";
        } else {
            if (strlen($field) < $rules[$key]['min'] || strlen($field) > $rules[$key]['max']) {
                $_SESSION[$key] = "Your message must be {$rules[$key]['min']} to {$rules[$key]['max']} characters long";
            } else {
                if (isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }



    if (count($_SESSION) == 0) {
        echo "insert";
        $title = htmlspecialchars($_POST['title']);
        $body = htmlspecialchars($_POST['body']);
        save_data($title, $body);
        // die;
    }

    header("Location: http://localhost:8008/BulletinBoard/index.php");
}
function save_data($title, $body)
{
    global $msqli;

    $query = "INSERT INTO bulletins (`title`, `body`) VALUES ('$title', '$body')";

    if (!mysqli_query($msqli, $query)) {
        echo "error ";
    }

    // var_dump($created_at);
}


validation($_POST);
