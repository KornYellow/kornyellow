<?php

namespace libraries\korn\client;

use libraries\korn\KornConfig;

class KornHeader {
	private static string|null $title = null;
	private static string|null $description = null;
	private static string|null $abstract = null;
	private static string|null $canonical = null;
	public static function getTitle(): string {
		$title = self::$title ?? KornConfig::$defaultTitle;
		if ($title !== KornConfig::$defaultTitle) {
			$title .= ' | '.self::getWebsiteName();
		} else {
			$title = self::getWebsiteName();
		}
		return $title;
	}
	public static function getWebsiteName(): string {
		return KornConfig::$websiteName;
	}
	public static function getDescription(): string {
		return self::$description ?? KornConfig::$defaultDescription;
	}
	public static function getAbstract(): string {
		return self::$abstract ?? KornConfig::$defaultAbstract;
	}
	public static function getKeywords(): string {
		return KornConfig::$defaultKeywords;
	}
	public static function getAuthor(): string {
		return KornConfig::$websiteAuthor;
	}
	public static function getOwner(): string {
		return KornConfig::$websiteOwner;
	}
	public static function getCanonical(): string {
		return self::$canonical ?? "";
	}

	public static function setCanonical(string $canonical): void {
		self::$canonical = $canonical;
	}

	public static function constructHeader($title = null, $description = null, $abstract = null): void {
		self::$title = $title ?? KornConfig::$defaultTitle;
		self::$description = $description ?? KornConfig::$defaultDescription;
		self::$abstract = $abstract ?? KornConfig::$defaultAbstract;

		include('controller/header.php');
	}
}
