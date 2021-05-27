<?php

namespace App\Model;

use App\Model\Model;

class User extends Model
{
    protected $tableName = 'users';

    public function __construct()
    {
        parent::__construct();
    }
}
