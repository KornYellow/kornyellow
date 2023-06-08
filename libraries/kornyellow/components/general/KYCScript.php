<?php

namespace libraries\kornyellow\components\general;

class KYCScript {
	private static bool $isTransactionEnable = false;

	public static function isTransactionEnable(): bool {
		return self::$isTransactionEnable;
	}
	public static function enableTransaction(): void {
		self::$isTransactionEnable = true;
	}
}
