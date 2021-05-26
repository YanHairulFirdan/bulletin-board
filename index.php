<?php

require_once('vendor/autoload.php');

use App\Model\Bulletin as ModelBulletin;
use App\Utils\Pagination;
use App\Utils\Validation;


$bulletin          = new ModelBulletin();
$data['bulletins'] = $bulletin->orderBy('created_at', 'DESC')->paginate(10)->get();
$pagination        = new Pagination($bulletin->numRows());

$pagination->paginator();

$data['currentPage']    = $pagination->currentPage;
$data['previousPage']   = $pagination->previousPage;
$data['nextPage']       = $pagination->nextPage;
$data['startIndex']     = $pagination->startIndex;
$data['lastIndex']      = $pagination->lastIndex;


if ($_POST) {
    $rules = [
        'title' => 'required|length:20-42',
        'body'  => 'required|length:10-220',
    ];

    $validation = new Validation($rules);

    $validation->validate($_POST);

    $data['errorMessages'] = $validation->getErrorMessage();

    if (!$data['errorMessages']) {
        $bulletin->create($_POST);
        header("Refresh:0");
    }
}
// load the view
load_view('index', $data);
