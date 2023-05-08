<?php

namespace libraries\korn\utils;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class KornDebug {
	#[NoReturn] public static function printError(string $text, string $error = null): void {
		if ($error)
			$error = "($error)";
		self::print("$text $error", self::getCallTrace());
		exit();
	}
	public static function print(string $string, string $detail = null): void {
		if ($detail)
			$detail = "<div class='detail'>$detail</div>";
		else $detail = "";

		echo "
			<div class='debug'>
				$string$detail
			</div>
		";
	}
	public static function getCallTrace(): string {
		$exception = new Exception();
		$traces = explode("\n", $exception->getTraceAsString());
		$traces = array_reverse($traces);
		array_shift($traces);
		array_pop($traces);

		$return = "";
		foreach ($traces as $key => $trace) {
			$trace = substr($trace, strpos($trace, " "));
			$trace = substr($trace, 0, strpos($trace, ":"));
			$return .= ($key + 1).") ".$trace."<br/>";
		}

		return $return;
	}
	public static function printArray(array $array): void {
		$print = "<br/>".implode("<br/>", $array);
		self::print($print);
	}
}