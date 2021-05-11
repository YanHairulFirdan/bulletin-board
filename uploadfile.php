<?php
require_once('utils/Validation.php');

if ($_POST) {
    print_r($_FILES['type']);
    $rules = [
        'file'     => 'required|type:jpg,png,jpeg,gif'
    ];

    $validation     = new Validation($rules);
    $errorMessages  = $validation->validate($_POST);
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
    <form action="" method="post">
        <input type="file" name="file" id="">
        <br>
        <button type="submit">submit</button>
    </form>
</body>

</html>