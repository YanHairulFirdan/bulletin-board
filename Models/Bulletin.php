<?php

namespace App\Model;

use App\Model\Model;

class Bulletin extends Model
{
    protected $tableName = 'bulletins';

    public function __construct()
    {
        parent::__construct();
    }
}
