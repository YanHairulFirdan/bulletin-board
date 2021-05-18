<?php

namespace Lib\Database;


interface DatabaseConnectionInterface
{
    public function connect();
    public function getConnection();
    public static function getInstance();
}
