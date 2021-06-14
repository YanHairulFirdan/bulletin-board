<?php

use App\Models\Bulletin;

use App\Utils\Validation;

require_once '../vendor/autoload.php';

$bulletin = new Bulletin();

$bulletins = $bulletin->columns('title')->get();
dump($bulletins);
// dump(__DIR__);
// dump(dirname(__FILE__));
// // echo __DIR__;
// $bulletin  = new Bulletin();
// $bulletins = $bulletin->orderBy('created_at', 'DESC')->limit(10)->get();
// $bulletins = $bulletin->where('title', 'LIKE', 'DELETE%')->limit(10)->get();

// dump($bulletins);

die;



// $records = $bulletin->groupBy('created_at')->limit(10)->get();
// dump($records);
// dump(get_defined_constants(true)['user']);
// // $records = $bulletin->columns(['title'])->orderBy('created_at')->limit(1)->get();
// // dump(include 'return.php');
// dump(get_config_value("DATABASE_TYPE", "MYSQL"));
// $path = str_replace('\\', '/', dirname(__DIR__));
// dump($path);
// echo "<pre>";
// print_r($records);
// echo "</pre>";

// class StaticClass
// {
//     public static $number = 1;
//     public static function setNumber($number)
//     {
//         self::$number = $number;
//     }
// }


// test check_value function
// $config['databaseType'] = '';
// $config['host']         = 'localhost';
// $config['databaseName'] = 'New Database';
// $config['username']     = 'root';
// $config['password']     = 'this+is+pasword+123';


// $databaseType = check_value('databaseType', DATABASE_TYPE, $config);
// $host         = check_value('host', HOST, $config);
// $databaseName = check_value('databaseName', DATABASE_NAME, $config);
// $username     = check_value('username', USERNAME, $config);
// $password     = check_value('password', PASSWORD, $config);



// print_r($databaseType);
// echo "<br>";
// print_r($host);
// echo "<br>";
// print_r($databaseName);
// echo "<br>";
// print_r($username);
// echo "<br>";
// print_r($password);
// echo "<br>";

// this method will be use later in database class for custom query
// public static function query(string $query, $tableName)
// {
//     $selfInstance = new self($tableName);
//     $selfInstance->setConnection();

//     if (empty($query)) {
//         throw new Exception('query cannot be epty string');
//     }

//     return $selfInstance->connection->query($query)->fetchAll();
// }
// dump(Database::query("SELECT * FROM bulletins LIMIT 1", 'bulletins'));

/**
 * new way for pagination
 * 
 * number of paginator = 3
 * 
 * set start index 
 * check current page
 * if current page == => 1 start index = 1
 * else if current page - 2 >= 2 
 *  if number of pagination > 5
 *       start index = current page - 2
 *  
 * 
 * set last index
 * if number of pagination <= 5 => last index = number of pagination
 * else
 *  if current page + 2 < number of paginator? last index = current page + 2
 *  else if current page == number of pagination => last index = number of pagination
 * 
 * 
 *   */
// if (count($_FILES)) {
//     $rules = [
//         'username' => 'required|length:5-15',
//         'image'    => 'required|type:jpg,jpeg,gif|size:1000'
//     ];
//     $validation = new Validation($rules);
//     $validation->validate(array_merge($_POST, $_FILES));
//     $errorMSG = $validation->getErrorMessage();
//     if ($errorMSG) {
//         foreach ($errorMSG as $key => $msg) {
//             echo $msg . "<br>";
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form enctype="multipart/form-data" action="" method="post">
        <div>
            <label for="username">Upload username</label>
            <br>
            <input type="text" name="username" id="">
        </div>
        <div>
            <label for="image">Upload Image</label>
            <br>
            <input type="file" name="image" id="">
        </div>
        <br>
        <br>
        <button type="submit">submit</button>
    </form>
    <script>
        alert("you've been hacked");
    </script>
</body>

</html>