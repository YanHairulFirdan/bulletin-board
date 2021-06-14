<?php
require_once('../vendor/autoload.php');

use App\Models\Bulletin;
use App\Model\User;
use App\Utils\Validation;
use Lib\Utils\Validation as UtilsValidation;

$bulletin = new Bulletin();

$bulletinSpecificTitle = $bulletin->where('title', '=', "'dhfhfhkgjgj")->get();
$bulletinSpecificTitle1 = $bulletin->where('title', '=', "'gfufdiovjvjkl")->get();

dump($bulletinSpecificTitle);
dump($bulletinSpecificTitle1);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = ($_FILES) ? array_merge($_POST, $_FILES) : $_POST;

    $rules    = [
        'username' => 'required',
        'password' => 'required',
    ];

    $validator     = new UtilsValidation($rules);

    $validator->validate($formData);

    $errorMessages = $validator->getErrorMessage();

    // if (!$errorMessages) {

    // $user = new User();
    // $authUser = $user->whereAnd(['username', 'password'], [$_POST['username'], $_POST['password']])->get();
    // if ($authUser) {
    //     foreach ($authUser as $key => $profile) {
    //         dump($profile);
    //     }
    // }

    /**
     * where and for model class
     *     public function whereAnd(array $columns, array $values)
     *{
     *  $this->database->whereAnd($columns, $values);

     *   return $this;
     *}
     */

    /**
     * where and for database class
     *public function whereAnd(array $columns, array $values)
     *{  
     *$subQuery = 'WHERE ';
     *foreach ($columns as $key => $column) {
     *   if ($key != count($columns) - 1) {
     *      $subQuery .= "$column = :$column  AND ";
     * } else {
     *
     *               $subQuery .= "$column = :$column";
     *          }
     *     }
     *    // $subQuery          = " WHERE {$column} {$operator} :$column";
     *   $this->columnValue = $values;
     *  foreach ($values as $key => $value) {
     *     $this->columnName[":{$columns[$key]}"] = $value;
     *}
     *$this->query      .= $subQuery;
     *}
     */




    // return ($uploaded) ? "Success to upload file" : "Fail to upload file";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>

<body>
    <?php if (isset($errorMessages)) : ?>
        <ul>
            <?php foreach ($errorMessages as $key => $message) : ?>
                <li>
                    <?= $message ?>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">Userame</label>
            <br>
            <input type="text" name="username" id="">
        </div>

        <div>
            <label for="password">Password</label>
            <br>
            <input type="password" name="password" id="">
        </div>
        <button type="submit">Sign up</button>
    </form>
</body>

</html>