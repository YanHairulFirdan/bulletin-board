<?php
require_once('config/database_connection.php');
require_once('vendor/autoload.php');

use Faker\Factory;

$faker = Factory::create('id_ID');

for ($index = 0; $index < 36; $index++) {
    $title = $faker->text(32);
    $body =  $faker->text(200);

    mysqli_query($msqli, "INSERT INTO bulletins (title, body) VALUES ('{$title}', '{$body}')");
}

header('location:index.php');
