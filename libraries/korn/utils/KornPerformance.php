<?php

namespace libraries\korn\utils;

class KornPerformance {
	private static float|null $startLoadTime = null;
	private static float|null $stopLoadTime = null;
	private static int $queryCount = 0;
	public static function startMeasureLoadTime(): void {
		self::$startLoadTime = microtime(true);
	}
	public static function stopMeasureLoadTime(): void {
		self::$stopLoadTime = microtime(true);
	}
	public static function getMeasuredLoadTime(): string {
		if (is_null(self::$startLoadTime) || is_null(self::$stopLoadTime))
			return 'กรุณาเริ่มและหยุดเวลาที่จะวัดก่อน';
		return number_format(self::$stopLoadTime - self::$startLoadTime, 4);
	}
	public static function queryCountIncrease(): void {
		self::$queryCount += 1;
	}
	public static function getQueryCountMeasured(): string {
		return self::$queryCount;
	}
}