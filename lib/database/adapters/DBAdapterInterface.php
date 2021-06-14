<?php

namespace Lib\Database\Adapters;

interface DBAdapterInterface
{
    public function connect();

    public static function getInstance();
}
