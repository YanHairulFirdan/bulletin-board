<?php
return [
    "dbType" => get_config_value("DATABASE_TYPE", 'mysql'),
    "db_configs" => [
        'mysql' => [
            'databaseName' => 'bulletins',                           #get table from config
            'host'         => get_config_value('HOST', 'localhost'), #get host from config
            'username'     => get_config_value('USERNAME', 'root'),  #get username from config
            'password'     => get_config_value('PASSWORD', '')       #get password from config
        ]
    ]
];
