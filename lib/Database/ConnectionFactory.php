<?php

namespace Lib\Database;

class ConnectionFactory
{
	public static function create($connectionType = 'mysql', array $config = [])
	{
		switch ($connectionType) {
			case 'mysql':
				return MysqlConnection::getInstance($config);
				break;
			case 'Postgres':
				return PosgresConnection::getInstance($config);
				break;
		}
	}
}
