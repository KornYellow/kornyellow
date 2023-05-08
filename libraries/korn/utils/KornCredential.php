<?php

namespace libraries\korn\utils;

class KornCredential {
	public static function getDatabaseUsername(): string {
		return KornFile::getStringFromFile("/.CREDENTIAL/database", true)[0];
	}
	public static function getDatabasePassword(): string {
		return KornFile::getStringFromFile("/.CREDENTIAL/database", true)[1];
	}
	public static function getFTPIP(): string {
		return KornFile::getStringFromFile("/.CREDENTIAL/ftp", true)[0];
	}
	public static function getFTPUsername(): string {
		return KornFile::getStringFromFile("/.CREDENTIAL/ftp", true)[1];
	}
	public static function getFTPPassword(): string {
		return KornFile::getStringFromFile("/.CREDENTIAL/ftp", true)[2];
	}

	public static function getAPIKeyYoutube(): string {
		return KornFile::getStringFromFile("/.CREDENTIAL/apikey_youtube", true)[0];
	}
}