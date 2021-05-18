<?php

require_once('vendor/autoload.php');

use App\Model\Bulletin as ModelBulletin;
use App\Utils\Pagination;
use App\Utils\Validation;


$bulletin       = new ModelBulletin();
$numOfRows      = $bulletin->numRows();
$bulletins      = $bulletin->orderBy('created_at', 'DESC')->paginate(10);
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


    if (!$errorMessages) {
        $bulletin->create($_POST);
        header("Refresh:0");
    } else {
        $body  = $_POST['body'];
        $title = $_POST['title'];
    }
}

// load the view
require_once 'public/assets/views/index.view.php';
