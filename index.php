<?php
require_once('config/database_connection.php');
require_once('helpers/pagination.php');
require_once('helpers/debug.php');
session_start();

list($result, $numberOfPager) = pagination();

$currentPage = 1;
if ($numberOfPager > 5) {
    $pager = 5;
    $startIndex = (!isset($_REQUEST['page'])) ? 1 : intval($_REQUEST['page']);
    if ($numberOfPager < 10) {

        if ($startIndex > (($numberOfPager - $pager) + 1)) {
            $startIndex = ($numberOfPager - $pager) + 1;
        }
    } else {
        if ($startIndex > 5) {
            $startIndex = 6;
        } elseif ($startIndex == 5) {
            $startIndex = 3;
        }
    }
} else {
    $startIndex = 1;
    $pager = $numberOfPager;
}




if (isset($_REQUEST['page']) && intval($_REQUEST['page']) > 1) {
    $currentPage = intval($_REQUEST['page']);
}

print_debug($currentPage);
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
            /* padding: 1em; */
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

        .btn-page span {
            text-align: center;
            /* background-color: gray; */
            /* color: #fff; */
            align-items: center;

        }
    </style>
</head>

<body style="width: 60%; margin: auto;">
    <div class="container">
        <?php if (isset($_SESSION) && count($_SESSION) > 0) : ?>
            <ul style="width: inherit; padding: 2em; color: #fff; background-color: red;">
                <?php foreach ($_SESSION as $key => $data) : ?>
                    <li>
                        <?= $data ?>
                    </li>
                <?php endforeach;
                session_destroy(); ?>
            </ul>
        <?php endif; ?>
        <form action="save.php" method="POST" style="padding: 2em;">
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
    <?php while ($bulletin = mysqli_fetch_assoc($result)) : ?>
        <div class="board-wrapper" style="padding: 1em 2em; display: flex; justify-content: space-between; border-top: 1px solid #000; border-bottom: 1px solid #000;">
            <span class="board-title">
                <?= $bulletin['title'] ?>
            </span>
            <span class="date">
                <?= $bulletin['created_at'] ?>
            </span>
        </div>
    <?php endwhile ?>
    <div class="pagination" style="margin: 3em auto; width: 80%; display: flex; justify-content: space-between;">

        <?php if ($currentPage > 1) : ?>
            <span class="btn-page">
                <a href="?page=<?= $currentPage - 1 ?>">&lt;</a>
            </span>
        <?php endif ?>
        <?php for ($index = 0; $index < $pager; $index++) : ?>
            <?php if (($currentPage == $index + $startIndex)) : ?>
                <span class="btn-page">
                    <span><?= $index + $startIndex ?></span>
                </span>
            <?php else : ?>
                <span class="btn-page">
                    <a href="?page=<?= $startIndex + $index ?>"><?= $index + $startIndex ?></a>
                </span>
            <?php endif ?>
        <?php endfor ?>
        <?php if (!isset($_REQUEST['page']) || $currentPage < $numberOfPager) : ?>
            <span class="btn-page">
                <a href="?page=<?= $currentPage + 1 ?>">&gt;</a>
            </span>
        <?php endif ?>
    </div>
</body>

</html>