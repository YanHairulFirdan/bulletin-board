<?php

namespace Lib\Database;

use Exception;

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
	public static function create(string $connectionType)
	{
		switch ($connectionType) {
			case 'mysql':
				return MysqlAdapter::getInstance();
				break;
			case 'PostgresSQL':
				return PostgresSQLAdapter::getInstance();
				break;
			default:
				throw new Exception("Database type not found", 1);
				break;
		}
	}
}
