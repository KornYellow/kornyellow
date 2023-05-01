<?php

namespace libraries\korn\server\query\builder;

use libraries\korn\server\query\KornStatement;

class KornQueryReplace implements KornQueryBuilder {
	private string $table;
	private array $values = [];

	public function __construct(string $table) {
		$this->table = $table;
	}

	public function values(array $values): void {
		$this->values = $values;
	}

	public function build(): string {
		$fieldsName = KornStatement::getFieldsName($this->table);
		if (count($this->values) != count($fieldsName)) {
			return '';
		}

		$insertValues = array_map(function ($value) {
			return is_null($value) ? 'null' : '"'.$value.'"';
		}, $this->values);

		$insertStatement = 'INSERT INTO `'.$this->table.'` ';
		$insertStatement .= '('.implode(', ', $fieldsName).') ';
		$insertStatement .= 'VALUES ('.implode(', ', $insertValues).')';

		$updateStatements = array_map(function ($fieldName, $value) {
			$escapedValue = is_null($value) ? 'null' : '"'.$value.'"';
			return $fieldName.' = '.$escapedValue;
		}, $fieldsName, $this->values);

		$updateStatement = 'ON DUPLICATE KEY UPDATE ';
		$updateStatement .= implode(', ', $updateStatements);

		return $insertStatement.' '.$updateStatement;
	}
}
