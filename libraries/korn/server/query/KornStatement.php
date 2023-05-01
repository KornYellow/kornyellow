<?php

namespace libraries\korn\server\query;

use libraries\korn\server\connection\KornDatabaseConnection;
use libraries\korn\utils\KornDebug;
use mysqli_stmt;

class KornStatement {
	public static function getFieldsName(string $table): array {
		$statement = self::prepare(query: 'SELECT * FROM `'.$table.'`');

		$result = $statement->get_result();
		$fields = $result->fetch_fields();

		$fieldsName = [];
		foreach ($fields as $field)
			$fieldsName[] = $field->name;

		return $fieldsName;
	}
	public static function prepare(string $query): mysqli_stmt {
		$connection = KornDatabaseConnection::getDatabase();
		$statement = $connection->prepare($query);

		if (!$statement)
			KornDebug::printError('ERROR: Failed to prepare query', $connection->error);

		$statement->execute();

		return $statement;
	}
	public static function getEmptyFieldsName(string $table): array {
		$emptyFields = [];

		$statement = self::prepare('SELECT * FROM `'.$table.'`');

		$result = $statement->get_result();
		$fields = $result->fetch_fields();

		foreach ($fields as $field)
			$emptyFields[$field->name] = null;

		return $emptyFields;
	}
}
