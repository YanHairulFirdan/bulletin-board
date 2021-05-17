<?php

namespace Lib\Database;

class Connection implements SomeInterface
{
    public function __construct()
    {
        echo 'created :)';
    }

    public function methods()
    {
        echo 'this is from methods';
    }
}
