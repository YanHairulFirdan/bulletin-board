<?php
require_once('utils/Validation.php');

if ($_POST || $_FILES) {
    // print_r($_FILES['type']);
    $rules = [
        'file'     => 'required|type:jpg,png,jpeg,gif'
    ];

    // dump($_FILES);
    $validation     = new Validation($rules);
    $errorMessages  = $validation->validate(array_merge($_POST, $_FILES));
    if ($errorMessages) {
        # code...
        dump($errorMessages);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file</title>
</head>

<body>
    <form enctype="multipart/form-data" action="" method="post">
        <input type="text" name="name" id="">
        <input type="file" name="file" id="">
        <br>
        <button type="submit">submit</button>
    </form>
</body>

</html>