<?php

namespace libraries\korn\utils;

class KornFile {
	public static function getIntFromFile(string $path): string {
		return intval(self::getStringFromFile($path));
	}
	public static function getStringFromFile(string $path, bool $isArray = false): array|string {
		$fileRead = fopen(KornNetwork::getDocumentRoot().$path, "r");

		$string = [];
		while (!feof($fileRead))
			$string[] = trim(fgets($fileRead));

		fclose($fileRead);
		return ($isArray) ? $string : $string[0];
	}
	public static function writeToFile(string $path, string $text): void {
		$fileWrite = fopen(KornNetwork::getDocumentRoot().$path, "w");
		fwrite($fileWrite, $text);
		fclose($fileWrite);
	}
}