<?php
require_once('vendor/autoload.php');
require_once('Database/DatabaseConnection.php');
require_once('Database/Model.php');
require_once('helpers/functions.php');
require_once('utils/Validation.php');
require_once('utils/Pagination.php');


$databaseConnection = DatabaseConnection::getInstance();
$bulletinsModel     = new Model($databaseConnection, 'bulletins');
$pagination         = new Pagination($bulletinsModel->numberOfRecord());
$bulletins          = $bulletinsModel->getData();
$pagination->paginator();
// change to pagination getCurrentPage() for example
$startIndex = $pagination->startIndex;
$pagination->printPropertyValue('startIndex');
echo "<br>";
$currentPage = $pagination->currentPage;
$pagination->printPropertyValue('currentPage');
echo "<br>";
$previousPage = $pagination->previousPage;
$pagination->printPropertyValue('previousPage');
echo "<br>";
$pagination->printPropertyValue('nextPage');
echo "<br>";
$nextPage = $pagination->nextPage;
$pagination->printPropertyValue('lastIndex');
echo "<br>";
$lastIndex = $pagination->lastIndex;
$pagination->printPropertyValue('numberOfButton');
echo "<br>";
$numberOfButton = $pagination->numberOfButton;


// list(
//     $currentPage,
//     $startIndex,
//     $previousPage,
//     $nextPage,
//     $pagerButton
// )                           = $pagination->paginator();
// change for pagination

if ($_POST) {
    $rules = [
        'title' => 'required|length:10-32',
        'body'  => 'required|length:10-220',
    ];

    $validation    = new Validation($rules);
    $errorMessages = $validation->validate($_POST);
    $body          = $_POST['body'];
    $title         = $_POST['title'];
    if (!$errorMessages) {
        $bulletinsModel->create($_POST);
    }
}


require_once 'public/assets/views/index.view.php';
