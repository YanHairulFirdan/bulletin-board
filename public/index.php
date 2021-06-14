<?php

require_once('../app/core/bootstrap.php');

use App\Models\Bulletin;
use App\Validations\BulletinValidation;
use Lib\Utils\Logger;
use Lib\Utils\Pagination;

try {
    $bulletin   = new Bulletin();
    $pagination = new Pagination($bulletin->numRows(), 10, 7, 'page');

    $page  = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = $pagination->dataPerPage;

    $pagination->setCurrentPage($page);
    $pagination->paginator();

    $offset    = $pagination->currentPage;
    $bulletins = $bulletin->orderBy('created_at', 'DESC')->limit($limit)->offset($offset)->get();

    if ($formData = $_POST) {
        $validator = new BulletinValidation();
        $validator->validate($formData);

        if (!$errors = $validator->getErrorMessage()) {
            $bulletin->create($formData);

            redirect('index.php');
        }
    }

    require_once "assets/views/index.view.php";
} catch (\Throwable $e) {
    error_log($e->getMessage());

    throw $e;
}
