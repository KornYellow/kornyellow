<?php

namespace libraries\korn\server\connection;

use FTP\Connection;
use libraries\korn\utils\KornCredential;
use libraries\korn\utils\KornDebug;

class KornFTPConnection {
	private static Connection|null $connection = null;

	public static function getFTP(): Connection {
		return self::getConnection(
			KornCredential::getFTPUsername(),
			KornCredential::getFTPPassword(),
			KornCredential::getFTPIP(),
		);
	}
	private static function getConnection(
		string $username,
		string $password,
		string $ftpServer,
	): Connection {
		if (self::$connection)
			return self::$connection;

		if (!$connection = ftp_connect($ftpServer))
			KornDebug::printError('ERROR: FTP Server connection error');

		if (!$login = ftp_login($connection, $username, $password))
			KornDebug::printError('ERROR: FTP Server login error');

		self::$connection = $connection;
		return $connection;
	}
	public static function closeConnection(): void {
		if (self::$connection)
			ftp_close(self::$connection);
	}
}