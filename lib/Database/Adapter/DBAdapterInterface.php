<?php

namespace Lib\Database\Adapter;

interface DBAdapterInterface
{
    public function connect();
    public static function getInstance();
}
