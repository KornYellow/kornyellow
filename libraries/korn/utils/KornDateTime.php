<?php

namespace libraries\korn\utils;

use DateTime;
use Exception;

class KornDateTime {
	private DateTime $dateTime;

	public function __construct(string|DateTime $time = null) {
		if ($time instanceof DateTime) {
			$this->dateTime = $time;
		} else if ($time) {
			try {
				$this->dateTime = new DateTime($time);
			} catch (Exception $e) {
				KornDebug::printError("ERROR: Failed to parse time string", $e->getMessage());
			}
		} else {
			$this->dateTime = new DateTime();
		}
	}
	public static function createFromDateThai(int $date, int $month, int $year): KornDateTime|null {
		return self::createFromDate($date, $month, $year - 543);
	}
	public static function createFromDate(int $date, int $month, int $year): KornDateTime|null {
		$dateTime = DateTime::createFromFormat("Y-n-d", "$year-$month-$date");
		if ($dateTime)
			return new KornDateTime($dateTime);

		return null;
	}
	public static function createFromDateTimeThai(int $date, int $month, int $year, int $hour, int $minute, int $second): KornDateTime|null {
		return self::createFromDateTime($date, $month, $year - 543, $hour, $minute, $second);
	}
	public static function createFromDateTime(int $date, int $month, int $year, int $hour, int $minute, int $second): KornDateTime|null {
		$minute = str_pad($minute, 2, "0", STR_PAD_LEFT);
		$second = str_pad($second, 2, "0", STR_PAD_LEFT);

		$dateTime = DateTime::createFromFormat("Y-n-d G:i:s", "$year-$month-$date $hour:$minute:$second");
		if ($dateTime)
			return new KornDateTime($dateTime);

		return null;
	}
	public function getDifferenceInSeconds(KornDateTime $subject): float {
		$startDate = $this->dateTime;
		$endDate = $subject->dateTime;
		$microsecondsDiff = ($startDate->format("u") - $endDate->format("u")) / (1000 * 1000);
		$timeDifference = $startDate->diff($endDate);
		$seconds = (int)$timeDifference->format("%s") - $microsecondsDiff;
		$minutesInSeconds = (int)($timeDifference->format("%i")) * 60;
		$hoursInSeconds = (int)($timeDifference->format("%h")) * 60 * 60;
		return abs($hoursInSeconds + $minutesInSeconds + $seconds);
	}
	public function getDifferenceInHours(KornDateTime $subject): int {
		$startDate = $this->dateTime;
		$endDate = $subject->dateTime;
		$timeDifference = $startDate->diff($endDate);
		return abs(intval($timeDifference->format("%r%a")) * 24 + intval($timeDifference->format("%h")));
	}
	public function getDifferenceInDays(KornDateTime $subject): int {
		$startDate = $this->dateTime;
		$endDate = $subject->dateTime;
		$timeDifference = $startDate->diff($endDate);
		return abs($timeDifference->format("%r%a"));
	}
	public function getDifferenceInMonths(KornDateTime $subject): int {
		$startDate = $this->dateTime;
		$endDate = $subject->dateTime;
		$timeDifference = $startDate->diff($endDate);
		return abs(intval($timeDifference->format("%r%y")) * 12 + intval($timeDifference->format("%m")));
	}
	public function getDifferenceInYears(KornDateTime $subject): int {
		$startDate = $this->dateTime;
		$endDate = $subject->dateTime;
		$timeDifference = $startDate->diff($endDate);
		return abs($timeDifference->format("%r%y"));
	}
	public function isSameDateDay(KornDateTime $subject): bool {
		return $this->getDate() == $subject->getDate() &&
			$this->getMonth() == $subject->getMonth() &&
			$this->getYear() == $subject->getYear();
	}
	public function getDate(): int {
		return $this->dateTime->format("j");
	}
	public function getMonth(): int {
		return $this->dateTime->format("n");
	}
	public function getYear(): int {
		return $this->dateTime->format("Y");
	}
	public function isSameDateMonth(KornDateTime $subject): bool {
		return $this->getMonth() == $subject->getMonth() &&
			$this->getYear() == $subject->getYear();
	}
	public function isSameDateYear(KornDateTime $subject): bool {
		return $this->getYear() == $subject->getYear();
	}
	public function getSecond(): int {
		return $this->dateTime->format("s");
	}
	public function getMinute(): int {
		return $this->dateTime->format("i");
	}
	public function getHour(): int {
		return $this->dateTime->format("G");
	}
	public function getDay(): string {
		return $this->dateTime->format("l");
	}
	public function getDayShortThai(): string {
		return match ($this->getDayShort()) {
			"Mon" => "จ.",
			"Tue" => "อ.",
			"Wed" => "พ.",
			"Thu" => "พฤ.",
			"Fri" => "ศ.",
			"Sat" => "ส.",
			"Sun" => "อา.",
			default => "",
		};
	}
	public function getDayShort(): string {
		return $this->dateTime->format("D");
	}
	public function getYearShort(): int {
		return $this->getYear() % 100;
	}
	public function getYearShortThai(): int {
		return $this->getYearThai() % 100;
	}
	public function getYearThai(): int {
		return $this->getYear() + 543;
	}
	public function toString(): string {
		return $this->getDate()." ".
			$this->getMonthString()." ".
			$this->getYear();
	}
	public function getMonthString(): string {
		return $this->dateTime->format("F");
	}
	public function toStringThai(): string {
		return $this->getDate()." ".
			$this->getMonthStringThai()." ".
			$this->getYearThai();
	}
	public function getMonthStringThai(): string {
		return match ($this->getMonth()) {
			1 => "มกราคม",
			2 => "กุมภาพันธ์",
			3 => "มีนาคม",
			4 => "เมษายน",
			5 => "พฤษภาคม",
			6 => "มิถุนายน",
			7 => "กรกฎาคม",
			8 => "สิงหาคม",
			9 => "กันยายน",
			10 => "ตุลาคม",
			11 => "พฤศจิกายน",
			12 => "ธันวาคม",
		};
	}
	public function toStringThaiFormal(): string {
		return "วัน{$this->getDayThai()}ที่ {$this->getDate()} {$this->getMonthStringThai()} พ.ศ.{$this->getYearThai()}";
	}
	public function getDayThai(): string {
		return match ($this->getDayShort()) {
			"Mon" => "จันทร์",
			"Tue" => "อังคาร",
			"Wed" => "พุธ",
			"Thu" => "พฤหัสบดี",
			"Fri" => "ศุกร์",
			"Sat" => "เสาร์",
			"Sun" => "อาทิตย์",
			default => "",
		};
	}
	public function toStringShort(): string {
		return $this->getDate()." ".
			$this->getMonthStringShort()." ".
			$this->getYear();
	}
	public function getMonthStringShort(): string {
		return $this->dateTime->format("M");
	}
	public function toStringShortThai(): string {
		return $this->getDate()." ".
			$this->getMonthStringShortThai()." ".
			$this->getYearThai();
	}
	public function getMonthStringShortThai(): string {
		return match ($this->getMonth()) {
			1 => "ม.ค.",
			2 => "ก.พ.",
			3 => "มี.ค.",
			4 => "เม.ย.",
			5 => "พ.ค.",
			6 => "มิ.ย.",
			7 => "ก.ค.",
			8 => "ส.ค.",
			9 => "ก.ย.",
			10 => "ต.ค.",
			11 => "พ.ย.",
			12 => "ธ.ค.",
		};
	}
	public function toStringShortThaiFormal(): string {
		return "วัน".$this->getDayThai()."ที่ ".
			$this->getDate()." ".
			$this->getMonthStringShortThai()." ".
			$this->getYearThai();
	}

	public function toStringTimeSecond(): string {
		return $this->dateTime->format("H:i:s");
	}
	public function toStringTime(): string {
		return $this->dateTime->format("H:i");
	}

	public function toMySQLDate(): string {
		return $this->dateTime->format("Y-m-d");
	}
	public function toMySQLDateTime(): string {
		return $this->dateTime->format("Y-m-d H:i:s");
	}

	public function getMonths(): array {
		return [
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December",
		];
	}
	public function getMonthsThai(): array {
		return [
			"มกราคม",
			"กุมภาพันธ์",
			"มีนาคม",
			"เมษายน",
			"พฤษภาคม",
			"มิถุนายน",
			"กรกฎาคม",
			"สิงหาคม",
			"กันยายน",
			"ตุลาคม",
			"พฤศจิกายน",
			"ธันวาคม",
		];
	}

	public function modifyDay(int $day): KornDateTime {
		if ($day > 0)
			$day = "+".$day;
		$this->dateTime->modify("$day day");
		return $this;
	}
	public function modifyMonth(int $month): KornDateTime {
		if ($month > 0)
			$month = "+".$month;
		$this->dateTime->modify("first day of $month month");
		return $this;
	}
	public function modifyYear(int $year): KornDateTime {
		if ($year > 0)
			$year = "+".$year;
		$this->dateTime->modify("$year year");
		return $this;
	}
}