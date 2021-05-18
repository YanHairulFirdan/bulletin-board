<?php

require_once('vendor/autoload.php');

use App\Model\Bulletin as ModelBulletin;

$bulletin       = new ModelBulletin();
$numOfRows      = $bulletin->numRows();
$bulletins      = $bulletin->paginate(10);
$pagination     = new Pagination($numOfRows);
$pagination->paginator();

$startIndex     = $pagination->startIndex;
$currentPage    = $pagination->currentPage;
$previousPage   = $pagination->previousPage;
$nextPage       = $pagination->nextPage;
$lastIndex      = $pagination->lastIndex;
$numberOfButton = $pagination->numberOfButton;


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
