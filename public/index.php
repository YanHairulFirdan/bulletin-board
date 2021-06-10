<?php

require_once('../vendor/autoload.php');

use App\Models\Bulletin;
use Lib\Utils\Pagination;
use Lib\Utils\Validation;

try {
    $bulletin   = new Bulletin();
    $pagination = new Pagination($bulletin->numRows());
    $param      = $_GET ?: 1;
    $limit      = $pagination->dataPerPage;

    $pagination->setCurrentPage($param);

    $pagination->paginator();

    $offset    = $pagination->currentPage;
    $bulletins = $bulletin->orderBy('created_at', 'DESC')->limit($limit)->offset($offset)->get();

    if ($formData = $_POST) {
        $rules      = [
            'title' => 'required|length:10-180',
            'body'  => 'required|length:10-220',
        ];
        $validation = new Validation($rules);

        $validation->validate($formData);

        $errors     = $validation->getErrorMessage();

        if (!$errors) {
            $bulletin->create($formData);

            redirect('index.php');
        }
    }

    require_once "assets/views/index.view.php";
} catch (Exception $e) {
    dump($e->getMessage());
}
