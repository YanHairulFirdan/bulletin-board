<?php

namespace App\Model;

use Lib\Model\Model;

class User extends Model
{
    protected $tableName = 'users';

    public function __construct()
    {
        parent::__construct();
    }
}
