<?php

namespace libraries\korn\server\query\builder;

class KornQueryRemove implements KornQueryBuilder {
	private string $table;
	private array $values = [];

	public function __construct(string $table) {
		$this->table = $table;
	}

	public function values(array $values): void {
		$this->values = $values;
	}

	public function build(): string {
		// TODO: Implemewnt Build Remove!
		return '';
	}
}
