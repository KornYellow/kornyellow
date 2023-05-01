<?php

namespace libraries\korn\utils;

class KornNetwork {
	private static string $header;
	private static string $description;
	private static string $abstract;

	private static KornDateTime $startPageLoadTime;
	private static KornDateTime $stopPageLoadTime;

	public static function getHeader(): string {
		return self::$header;
	}
	public static function setHeader(string $header): void {
		self::$header = $header;
	}
	public static function getDescription(): string {
		return self::$description;
	}
	public static function setDescription(string $description): void {
		self::$description = $description;
	}
	public static function getAbstract(): string {
		return self::$abstract;
	}
	public static function setAbstract(string $abstract): void {
		self::$abstract = $abstract;
	}
	public static function getCurrentDomain(): string {
		return $_SERVER['HTTP_HOST'];
	}
	public static function getCurrentDomainURL(): string {
		if (self::isHTTPS())
			return 'https://'.self::getHost();

		return 'http://'.self::getHost();
	}
	public static function isHTTPS(): bool {
		if ($_SERVER['HTTPS'] ?? false)
			return true;

		return false;
	}
	public static function getHost(): string {
		return $_SERVER['HTTP_HOST'];
	}
	public static function getAbsolutePath(string $path): string {
		$parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
		$absolutes = [];
		foreach ($parts as $part) {
			if ($part == '.')
				continue;

			if ($part == '..')
				array_pop($absolutes);
			else
				$absolutes[] = $part;
		}

		return implode(DIRECTORY_SEPARATOR, $absolutes);
	}
	public static function getRequestMethod(): string {
		return $_SERVER['REQUEST_METHOD'];
	}
	public static function getDocumentRoot(): string {
		return $_SERVER['DOCUMENT_ROOT'];
	}
	public static function isLocalHost(): bool {
		if (self::getRemoteIP() == '127.0.0.1')
			return true;

		return false;
	}
	public static function getRemoteIP(): string {
		$clientIP = $_SERVER['HTTP_CLIENT_IP'] ?? '';
		if (filter_var($clientIP, FILTER_VALIDATE_IP))
			return $clientIP;

		return $_SERVER['REMOTE_ADDR'];
	}
	public static function redirectPage($url = '/', $delay = 0, $isExit = true): void {
		if (substr($url, 1) == self::getRequestPath())
			return;
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'" />';
		if ($isExit)
			exit;
	}
	public static function getRequestPath(): string {
		$requestURI = $_SERVER['REQUEST_URI'];
		if ($requestURI == '/')
			return '';

		return substr($requestURI, 1);
	}
}
