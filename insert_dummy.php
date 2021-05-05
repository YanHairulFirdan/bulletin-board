<?php
// require_once('config/database_connection.php');
// require_once('vendor/autoload.php');

// use Faker\Factory;

// $faker = Factory::create('id_ID');

// for ($index = 0; $index < 36; $index++) {
//     $title = $faker->text(32);
//     $body =  $faker->text(200);

//     mysqli_query($msqli, "INSERT INTO bulletins (title, body) VALUES ('{$title}', '{$body}')");
// }

// header('location:index.php');
class a
{
    public static function calling()
    {
        echo "a called!! \n";
    }
}
class b
{
    public static function calling()
    {
        echo "b called!! \n";
    }
}

// function a()
// {
//     echo "a \n";
// }
// function b()
// {
//     echo "b \n";
// }
$rules = [
    'title' => 'required|length:10-32',
    'body'  => 'required|length:10-220',
];
$a = 1;
$b = 2;
$arr = ['A' => 'a', 'B' => 'b'];
foreach ($arr as $key => $value) {
    $value::calling();
}

/*
step by step validation
loop through the $key=>data
    loop through the rule
        $errorMessage[$key] = instance/call(if method is static) rule class pass
    endloop
endloop
    





*/
