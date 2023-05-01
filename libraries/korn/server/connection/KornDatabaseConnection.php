<?php

namespace libraries\korn\server\connection;

use libraries\korn\KornConfig;
use libraries\korn\utils\KornCredential;
use libraries\korn\utils\KornDebug;
use libraries\korn\utils\KornNetwork;
use mysqli;

class KornDatabaseConnection {
	private static mysqli|null $connection = null;

	public static function getDatabase(): mysqli {
		if (KornNetwork::isLocalHost())
			return self::getConnection('root', '', KornConfig::$databaseBeta);

		return self::getConnection(
			KornCredential::getDatabaseUsername(),
			KornCredential::getDatabasePassword(),
			KornConfig::$databaseProduction,
		);
	}
	private static function getConnection(
		string $username,
		string $password,
		string $databaseName,
	): mysqli {
		if (self::$connection)
			return self::$connection;

		$connection = mysqli_init();

		if (!$connection->real_connect('p:localhost', $username, $password, $databaseName))
			KornDebug::printError('ERROR: MySQL connection error', mysqli_connect_error());
		$connection->set_charset('utf8');

		self::$connection = $connection;
		return $connection;
	}
	public static function closeConnection(): void {
		if (self::$connection)
			mysqli_close(self::$connection);
	}
}
