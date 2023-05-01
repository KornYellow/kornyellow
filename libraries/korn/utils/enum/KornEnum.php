<?php

namespace libraries\korn\utils\enum;

abstract class KornEnum implements KornEnumComparable {
	protected array $values;
	public function __construct(...$values) {
		$this->values = $values;
	}
	abstract public static function create($value): KornEnum|null;
	public function compareTo(KornEnumComparable $subject): bool {
		return $this->__toString() === $subject->__toString();
	}
	public function __toString() {
		return serialize($this);
	}
}