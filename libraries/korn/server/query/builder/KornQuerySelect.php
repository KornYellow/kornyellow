<?php

namespace libraries\korn\server\query\builder;

use libraries\korn\server\connection\KornDatabaseConnection;
use libraries\korn\utils\KornDateTime;

class KornQuerySelect implements KornQueryBuilder {
	private string $table;

	private string $where = '';
	private string|null $order = null;
	private bool $isDescending = false;
	private int|null $limit = null;
	private int|null $offset = null;

	public function __construct(string $table) {
		$this->table = $table;
	}

	public function where(string $column, string|null $value): void {
		$connection = KornDatabaseConnection::getDatabase();
		$this->where .= '(';
		$this->where .= mysqli_real_escape_string($connection, $column);
		$this->where .= '=';
		$this->where .= is_null($value) ? 'null' : '"'.mysqli_real_escape_string($connection, $value).'"';
		$this->where .= ')';
	}
	public function whereDateInDay(string $column, KornDateTime $day): void {
		$connection = KornDatabaseConnection::getDatabase();
		$this->where .= '(';
		$this->where .= mysqli_real_escape_string($connection, $column);
		$this->where .= ' BETWEEN ';
		$this->where .= '\''.$day->toMySQLDate().' 00:00:00\' AND \''.$day->toMySQLDate().' 23:59:59\'';
		$this->where .= ')';
	}
	public function whereDateInMonth(string $column, KornDateTime $month): void {
		$connection = KornDatabaseConnection::getDatabase();
		$this->where .= '(';
		$this->where .= mysqli_real_escape_string($connection, $column);
		$this->where .= ' BETWEEN ';
		$this->where .= '\''.substr($month->toMySQLDate(), 0, 8).'01 00:00:00\' AND CONCAT(LAST_DAY(\''.substr($month->toMySQLDate(), 0, 8).'01\'), \' 23:59:59\')';
		$this->where .= ')';
	}
	public function whereDateInYear(string $column, KornDateTime $year): void {
		$connection = KornDatabaseConnection::getDatabase();
		$this->where .= '(';
		$this->where .= mysqli_real_escape_string($connection, $column);
		$this->where .= ' BETWEEN ';
		$this->where .= '\''.substr($year->toMySQLDate(), 0, 5).'01-01 00:00:00\' AND CONCAT(LAST_DAY(\''.substr($year->toMySQLDate(), 0, 5).'12-01\'), \' 23:59:59\')';
		$this->where .= ')';
	}
	public function whereRaw(string $where): void {
		$this->where = $where;
	}

	public function whereAnd(): void {
		$this->where .= ' AND ';
	}
	public function whereOr(): void {
		$this->where .= ' OR ';
	}

	public function sortByColumn(string $column): void {
		$this->order = $column;
	}
	public function sortDescending(bool $bool = true): void {
		$this->isDescending = $bool;
	}
	public function limit(int $limit): void {
		$this->limit = $limit;
	}
	public function offset(int $offset): void {
		$this->offset = $offset;
	}
	public function build(): string {
		$build = 'SELECT * FROM `'.$this->table.'` ';

		if ($this->where)
			$build .= 'WHERE '.$this->where.' ';

		if ($this->order)
			$build .= 'ORDER BY '.$this->table.'.'.$this->order.' ';

		if ($this->isDescending)
			$build .= 'DESC ';


		if ($this->limit > 0) {
			$build .= 'LIMIT ';
			if ($this->offset == 0)
				$build .= $this->limit;
			else if ($this->offset > 0)
				$build .= $this->offset.', '.$this->limit;
		}

		return $build;
	}
}
