<?php
return [
    "dbType" => config("DATABASE_TYPE", 'mysql'),
    "db_configs" => [
        'mysql' => [
            'databaseName' => config('DATABASE_NAME'),                           #get table from config
            'host'         => config('HOST', 'localhost'), #get host from config
            'username'     => config('USERNAME', 'root'),  #get username from config
            'password'     => config('PASSWORD')       #get password from config
        ]
    ]
];
