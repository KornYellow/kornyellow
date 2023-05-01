<?php

namespace libraries\korn\client;

use libraries\korn\utils\KornString;

class KornRequestValue {
	private string|float|int|null $value;

	public function __construct($value) {
		$this->value = $value;
	}

	public function toInteger(): int {
		return is_numeric($this->value) ? intval($this->value) : 0;
	}
	public function toFloat(): float {
		return is_numeric($this->value) ? floatval($this->value) : 0.0;
	}
	public function toString(): string {
		return is_string($this->value) ? KornString::cleanString($this->value) : '';
	}
	public function toStringNullable(): string|null {
		return KornString::cleanStringNullable($this->value);
	}
	public function isNull(): bool {
		return $this->value === null;
	}
	public function isValid(): bool {
		return $this->value !== null;
	}
}
