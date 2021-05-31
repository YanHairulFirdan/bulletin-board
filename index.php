<?php

require_once('vendor/autoload.php');

use App\Model\Bulletin;
use Lib\Utils\Pagination;
use Lib\Utils\Validation;

$bulletin   =  new Bulletin();
$bulletins  = $bulletin->orderBy('created_at', 'DESC')->limit(10)->get();
$pagination = new Pagination($bulletin->numRows());
$param      = (!empty($_GET)) ? $_GET : 1;

$pagination->setCurrentPage($param);

$pagination->paginator();

if ($_POST) {
    $rules      = [
        'title' => 'required|length:10-180',
        'body'  => 'required|length:10-220',
    ];
    $formData   = $_POST;
    $validation = new Validation($rules);

    $validation->validate($formData);

    $errorMessages = $validation->getErrorMessage();

    if (!$errorMessages) {
        $bulletin->create($formData);
        header("Refresh:0");
    }

    load_view('index', ['bulletins' => $bulletins, 'pagination' => $pagination, 'errorMessages' => $errorMessages]);
}

load_view('index', compact('bulletins', 'pagination'));
