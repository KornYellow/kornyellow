<?php

namespace libraries\korn\utils;

class KornString {
	public static function generateRandomString(int $length): string {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);

		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}
	public static function cleanStringNullable(string $input): string|null {
		$cleanedInput = self::cleanString($input);
		return $cleanedInput === '' ? null : $cleanedInput;
	}
	public static function cleanString(string $input): string {
		$input = trim($input);
		$input = preg_replace('/\s+/', ' ', $input);
		$input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$input = str_replace("'", "''", $input);
		$input = str_replace("\\", "\\\\", $input);
		$input = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $input);
		return preg_replace('/<[^>]*>/', '', $input);
	}
}
