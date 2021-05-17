<?php

namespace App\Model;

use App\Databases\Model;

class Bulletin extends Model
{
    protected $tablename = 'bulletins';
    public function __construct()
    {
        parent::__construct();
    }
}
