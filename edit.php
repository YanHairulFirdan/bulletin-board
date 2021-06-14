<?php

use App\Models\Bulletin;
use App\Validations\BulletinValidation;

require_once('vendor/autoload.php');

$id = $_GET['id'];
$bulletinModel = new Bulletin();

$bulletin = $bulletinModel->findByID($id);

if ($formData = $_POST) {

    $validator = new BulletinValidation();
    $validator->validate($formData);

    if (!$errors = $validator->getErrorMessage()) {
        dump($bulletinModel->update($formData)->where('id', '=', $id)->execute());

        redirect('edit.php?id=' . $id);
    }
}
?>
<?php if (isset($errors)) : ?>
    <ul style="width: inherit; padding: 2em; color: #fff; background-color: red;">
        <?php foreach ($errors as $error) : ?>
            <li>
                <?= $error ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form action="edit.php?id=<?= $id ?>" method="POST" style="padding: 2em;">
    <div class="form-input" style="width: inherit;">
        <div class="input-title" style="margin: 2em 0;">
            <label for="title">
                Title
            </label>
        </div>
        <div class="input-field">
            <input type="text" name="title" style="display: inline-block; width: 100%; height: 2em;" style id="title" value="<?= $bulletin[0]['title'] ?>">
        </div>
    </div>
    <div class="form-input" style="width: inherit;">
        <div class="input-title" style="margin: 2em 0;">
            <label for="body">
                Body
            </label>
        </div>
        <div class="input-field">
            <textarea name="body" id="body" style="display: inline-block; width: 100%; height: 4em;" style><?= $bulletin[0]['body'] ?></textarea>
        </div>
    </div>
    <button class="btn" type="submit" style="margin-top: 2em; display: inline-block; width: 100%; height: 3em;">Submit</button>
</form>