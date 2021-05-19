<?php
namespace Lib\Database;

class ConnectionFactory{
	public static function create($connectionType='mysql')
	{
		switch ($connectionType) {
			case 'mysql':
				return MysqlConnection::getInstance();
				break;
			case 'Postgres':
				return PosgresConnection::getInstance();
				break;
		}
	}
}