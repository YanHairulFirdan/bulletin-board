<?php
require_once 'vendor/autoload.php';

require_once('Database/Model.php');
require_once('helpers/functions.php');
require_once('helpers/file_manipulation.php');
require_once('utils/Validation.php');


$messages            = read_file();
$bulletinsModel      = new Model('bulletins');
$bulletins           = $bulletinsModel->getData();
if ($_POST) {
    $rules = [
        'title' => [
            'required' => true,
            'min' => 10,
            'max' => 32
        ],
        'body' => [
            'required' => true,
            'min' => 10,
            'max' => 220
        ]
    ];
    $validation     = new Validation($rules);
    $errorMessages  = $validation->validate($_POST);
    if (!$errorMessages) {
        $bulletinsModel = new Model('bulletins');
        $bulletinsModel->create($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/style.css" type="text/css">
    <title>Dashboard</title>
    <style>
        * {
            text-decoration: none;
        }

        .btn-page {
            flex-shrink: 1;
            display: inline-block;
            height: inherit;
            width: inherit;
            text-align: center;

        }

        .btn-page a {
            display: inline-block;
            height: 100%;
            width: 100%;
            background-color: blue;
            padding: .4em;
            color: #fff;
        }

        .btn-page:hover {
            opacity: .8;
        }

        .error {
            background-color: red;
        }

        .success {
            background-color: green;
        }

        .btn-page span {
            text-align: center;
            align-items: center;

        }
    </style>
</head>

<body style="width: 60%; margin: auto;">
    <div class="container">
        <?php if (isset($errorMessages)) : ?>
            <ul style="width: inherit; padding: 2em; color: #fff; background-color: red;">
                <?php foreach ($errorMessages as $message) : ?>
                    <li>
                        <?= dump($message) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form action="" method="POST" style="padding: 2em;">
            <div class="form-input" style="width: inherit;">
                <div class="input-title" style="margin: 2em 0;">
                    <label for="title">
                        Title
                    </label>
                </div>
                <div class="input-field">
                    <input type="text" name="title" style="display: inline-block; width: 100%; height: 2em;" style id="title">
                </div>
            </div>
            <div class="form-input" style="width: inherit;">
                <div class="input-title" style="margin: 2em 0;">
                    <label for="body">
                        Body
                    </label>
                </div>
                <div class="input-field">
                    <textarea name="body" id="body" style="display: inline-block; width: 100%; height: 4em;" style></textarea>
                </div>
            </div>
            <button class="btn" type="submit" style="margin-top: 2em; display: inline-block; width: 100%; height: 3em;">Submit</button>
        </form>
    </div>

    <?php foreach ($bulletins->fetchAll() as $key => $bulletin) : ?>

        <div class="board-wrapper" style="padding: 1em 2em; display: flex; justify-content: space-between; border-top: 1px solid #000; border-bottom: 1px solid #000;">
            <span class="board-title">
                <?= $bulletin['title'] ?>
            </span>
            <span class="date">
                <?= $bulletin['created_at'] ?>
            </span>
        </div>
    <?php endforeach ?>

    <?php $bulletinsModel->pagination() ?>
</body>

</html>