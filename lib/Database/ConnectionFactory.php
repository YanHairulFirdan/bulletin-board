<?php

namespace Lib\Database;
/*
    |--------------------------------------------------------------------------
    | Factory connection
    |--------------------------------------------------------------------------
    |
    | This database class use for querying data like select, insert delete and update
    | it also provide some function to break data that will be used for insert and update
    |
    */

class ConnectionFactory
{
	public static function create(string $connectionType = 'mysql', array $config = [])
	{
		switch ($connectionType) {
			case 'mysql':
				return MysqlAdapter::getInstance($config);
				break;
			case 'PostgresSQL':
				return PostgresSQLAdapter::getInstance($config);
				break;
		}
	}
}
