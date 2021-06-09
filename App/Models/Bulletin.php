<?php

namespace App\Models;

use Lib\Model\Model as Model;

class Bulletin extends Model
{
    protected $tableName = 'bulletins';

    public function __construct()
    {
        parent::__construct();
    }
}
