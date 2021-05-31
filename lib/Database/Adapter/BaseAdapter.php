<?php

namespace Lib\Database\Adapter;

abstract class BaseAdapter
{
    protected $connection;
    protected $dsn;
    protected $databaseType;
    protected $host;
    protected $databaseName;
    protected $username;
    protected $password;
    protected static $instance = null;
}
