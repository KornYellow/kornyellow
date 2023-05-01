<?php

namespace libraries\korn\utils\enum;

interface KornEnumComparable {
	public function compareTo(self $subject);
}