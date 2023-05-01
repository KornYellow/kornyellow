<?php

namespace libraries\kornyellow\enums;

use libraries\korn\utils\enum\KornEnum;

class EnumTransactionType extends KornEnum {
	public static function create($value): EnumTransactionType|null {
		return match ($value) {
			'income' => self::INCOME(),
			'outcome' => self::OUTCOME(),
			default => null
		};
	}
	public static function INCOME(): self {
		return new self('income', 'รายรับ');
	}
	public static function OUTCOME(): self {
		return new self('outcome', 'รายจ่าย');
	}
	public function getID() {
		return $this->values[0];
	}
	public function getString() {
		return $this->values[1];
	}
}