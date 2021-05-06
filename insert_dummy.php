<?php
// require_once('config/database_connection.php');
require_once('vendor/autoload.php');
require_once('utils/Validation.php');

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

$data = [
    'title' => '',
    'body'  => 'fhfhfhfh',
];


$validation = new Validation($rules);
print_r($validation->validate($data));

// $a = 1;
// $b = 2;
// $arr = ['A' => 'a', 'B' => 'b'];
// foreach ($arr as $key => $value) {
//     $value::calling();
// }

/*
step by step validation
loop through the $key=>data
    loop through the rule
        $errorMessage[$key] = instance/call(if method is static) rule class pass
    endloop
endloop
*/
// $validation = new Validation([]);


/*
validation procedural
create file name validator for container all of validation type
step by step validation
loop through the $key=>data
    loop through the this->rule as rule
        $currentFieldrules = explode('|', rule)
        foreach $currentFieldrules as currentrule
            ruleContainValue = explode(':', currentrule)
            if(ruleContainValue)
                $errorMessage[key] = ruleContainValue[0]($field, $value, $ruleContainValue[1])
            else
                $errorMessage[key] = currentrule()
            
            
            if(empty(errormessage[key])) unset(errorMessage[key])

// foreach $currentFieldrules as currentrule
// $errorMessage[$type] = rule($data);
// errorMessage not null? continue;
// ldl
    endloop 
endloop
*/

// $arr = [
//     'title' => ['empty'],
//     'body' => [],
// ];


// echo !isset($arr) ? 'empty' : 'no';
// $str = 'ini string';
// echo empty($str) ? 'empty' : 'no';
// $arr = [
//     'required' => [],
//     'length' => [10, 220]
// ];
// $exploded = explode('|', $arr['title']);
// print_r(explode(':', $exploded[0]));
// unset($arr['required']);
// print_r($arr);
// $rulesArr = explode('|', $rules['title']);
// print_r($rulesArr);
// $currentRules = explode(':', $rulesArr[1]);
// print_r($currentRules);
// print_r(explode('-', $currentRules[1]));
