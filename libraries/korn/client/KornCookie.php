<?php

namespace libraries\korn\client;

class KornCookie {
	public static function set(string $key, string $value, int $time = 2147483647): void {
		if (isset($_COOKIE[$key]))
			$_COOKIE[$key] = $value;
		setcookie($key, $value, $time);
	}
	public static function unset(string $key): void {
		if (!isset($_COOKIE[$key]))
			return;
		unset($_COOKIE[$key]);
		setcookie($key, null, -1);
	}
	public static function read(string $key): string|null {
		if (!isset($_COOKIE[$key]))
			return null;

		return $_COOKIE[$key];
	}
	public static function isValid(string $key): bool {
		return isset($_COOKIE[$key]);
	}
	public static function isNull(string $key): bool {
		return !isset($_COOKIE[$key]);
	}
}
