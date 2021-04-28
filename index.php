<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/style.css" type="text/css">
    <title>Dashboard</title>
</head>

<body>
    <?php
    require_once('config/database_connection.php');
    require_once('helpers/pagination.php');
    require_once('helpers/debug.php');
    session_start();

    list($result, $pager) = pagination();

    $currentPage = 1;
    if ($pager >= 5) {
        $pager = 5;
        $startIndex = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
    } else {
        $startIndex = 1;
    }

    if (isset($_REQUEST['page']) && intval($_REQUEST['page']) <= $pager) {
        $currentPage = intval($_REQUEST['page']);
    }
    $startIndex = ($startIndex > 5) ? 6 : 1;
    ?>
    <?php if (isset($_SESSION)) : ?>
        <ul>
            <?php foreach ($_SESSION as $key => $data) : ?>
                <li>
                    <?= $data ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else :  ?>
        <?php session_destroy()  ?>
    <?php endif; ?>

    <div class="container">
        <form action="save.php" method="POST">
            <div class="form-input">
                <div class="input-title">
                    <label for="title">
                        Title
                    </label>
                </div>
                <div class="input-field">
                    <input type="text" name="title" id="title">
                </div>
            </div>
            <div class="form-input">
                <div class="input-title">
                    <label for="body">
                        Body
                    </label>
                </div>
                <div class="input-field">
                    <textarea name="body" id="body"></textarea>
                </div>
            </div>
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
    <?php while ($bulletin = mysqli_fetch_assoc($result)) : ?>
        <div class="board-wrapper">
            <span class="board-title">
                <?= $bulletin['title'] ?>
            </span>
            <span class="date">
                <?= $bulletin['created_at'] ?>
            </span>
        </div>
    <?php endwhile ?>
    <div class="pagination">

        <?php if ($currentPage != 1) : ?>
            <span class="btn-page">
                <a href="?page=<?= $currentPage - 1 ?>">&lt;</a>
            </span>
        <?php endif ?>
        <?php for ($index = 0; $index < $pager; $index++) : ?>
            <?php if ((isset($_REQUEST['page']) && ($currentPage == $index + $startIndex))) : ?>
                <span class="btn-page">
                    <span><?= $index + $startIndex ?></span>
                </span>
            <?php elseif (!isset($_REQUEST['page']) || ($currentPage == $index + $startIndex)) : ?>
                <span class="btn-page">
                    <span><?= $index + $startIndex ?></span>
                </span>
            <?php else : ?>
                <span class="btn-page">
                    <a href="?page=<?= $startIndex + $index ?>"><?= $index + $startIndex ?></a>
                </span>
            <?php endif ?>
        <?php endfor ?>
        <?php if (!isset($_REQUEST['page']) || $currentPage < $pager) : ?>
            <span class="btn-page">
                <a href="?page=<?= $currentPage + 1 ?>">&gt;</a>
            </span>
        <?php endif ?>
    </div>
</body>

</html>