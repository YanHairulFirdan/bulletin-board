<?php

require_once('../core/autoload.php');

use App\Models\Bulletin;
use App\Validations\BulletinValidation;
use Lib\Logger\ErrorLog;
use Lib\Pagination\Paginator;

try {
    $bulletin   = new Bulletin();
    $pagination = new Paginator(40, 10, 7);

    $page  = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;
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
    ErrorLog::logMessage($e->getMessage());

    redirect('error.php');
}
