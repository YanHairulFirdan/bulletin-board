<?php

require_once('../vendor/autoload.php');

use App\Models\Bulletin;
use App\Validations\BulletinValidation;
use Lib\Pagination\Pagination;

try {
    $bulletin = new Bulletin();

    $page  = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;

    $pagination = new Pagination(70, 10, 2, $page);
    $limit      = $pagination->getDataPerPage();
    $pagination->paginator();

    $offset = $pagination->getCurrentPage();

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
} catch (\Throwable $th) {
    throw $th;
}
