<?php

require_once('vendor/autoload.php');

use App\Model\Bulletin as ModelBulletin;
use App\Utils\Pagination;
use App\Utils\Validation;


$bulletin   = new ModelBulletin();
$bulletins  = $bulletin->orderBy('created_at', 'DESC')->paginate(10)->get();
$pagination = new Pagination($bulletin->numRows());

$pagination->paginator();

$currentPage  = $pagination->currentPage;
$previousPage = $pagination->previousPage;
$nextPage     = $pagination->nextPage;
$startIndex   = $pagination->startIndex;
$lastIndex    = $pagination->lastIndex;

// dump($bulletins);

if ($_POST) {
    $rules = [
        'title' => 'required|length:20-42',
        'body'  => 'required|length:10-220',
    ];

    $validation = new Validation($rules);

    $validation->validate($_POST);

    $errorMessages = $validation->getErrorMessage();

    if (!$errorMessages) {
        $bulletin->create($_POST);
        header("Refresh:0");
    }

    load_view('index', compact('bulletins', 'pagination', 'errorMessages'));
}

load_view('index', compact('bulletins', 'pagination'));
