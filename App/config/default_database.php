<?php

return [
    'type' => config(DATABASE_TYPE, 'mysql'),
    'config' => [
        'mysql' => [
            'databaseName' => config(DATABASE_NAME),     #get database from config
            'host'         => config(HOST, 'localhost'), #get host from config
            'username'     => config(USERNAME, 'root'),  #get username from config
            'password'     => config(PASSWORD)           #get password from config
        ],
        'sqlite' => [
            'databaseName' => config(DATABASE_NAME),      #get database from config
            'directory'    => config(DATABASE_DIRECTORY), #get database file
        ]
    ]
];
