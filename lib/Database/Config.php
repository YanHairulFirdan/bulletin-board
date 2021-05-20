<?php

namespace Lib\Database;

class Config
{
    private $databaseType;
    private $databaseName;
    private $host;
    private $username;
    private $password;


    public function setDatabaseType(string $databaseType)
    {
        if (!empty($databaseType)) {
            $this->databaseType = $databaseType;
        }
    }
    public function setDatabaseName(string $databaseName)
    {
        if (!empty($databaseName)) {
            $this->databaseName = $databaseName;
        }
    }
    public function setHost(string $host)
    {
        if (!empty($host)) {
            $this->host = $host;
        }
    }
    public function setUsername(string $username)
    {
        if (!empty($username)) {
            $this->username = $username;
        }
    }
    public function setPassword(string $password)
    {
        if (!empty($password)) {
            $this->password = $password;
        }
    }
}
