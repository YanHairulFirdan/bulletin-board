<?php
$host = "localhost";
$databaseName = "bulletinboard";
$username = "root";
$password = "";

try {
    $msqli = mysqli_connect($host, $username, $password, $databaseName);
} catch (\Throwable $th) {
    echo 'cannot make connection';
}
