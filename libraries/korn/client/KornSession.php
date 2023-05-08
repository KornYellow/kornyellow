<?php

namespace libraries\korn\client;

class KornSession {
	public static function set(string $key, bool|string|int $value): void {
		$_SESSION[$key] = $value;
	}
	public static function unset(string $key): void {
		if (!isset($_SESSION[$key]))
			return;
		unset($_SESSION[$key]);
	}
	public static function read(string $key): string {
		if (!isset($_SESSION[$key]))
			return "";

		return $_SESSION[$key];
	}
	public static function isValid(string $key): bool {
		return isset($_SESSION[$key]);
	}
	public static function isNull(string $key): bool {
		return !isset($_SESSION[$key]);
	}
}
