<?php

namespace libraries\kornyellow\instances\methods;

use KornyellowLib\Client\KornSession;
use KornyellowLib\Server\Query\Builder\KornQueryReplace;
use KornyellowLib\Server\Query\Builder\KornQuerySelect;
use KornyellowLib\Server\Query\KornQuery;
use KornyellowLib\Server\Query\KornStatement;
use KornyellowLib\Utils\KornNetwork;
use libraries\kornyellow\instances\classes\User;
use libraries\kornyellow\instances\KYInstance;
use libraries\kornyellow\instances\KYMethod;

class KYUser extends KYMethod {
	protected static string $table = "user";

	protected static array $getCache = [];
	protected static array $getByEmailCache = [];

	private static User|null $loggedIn = null;

	/**
	 * @param KornQuery $query
	 * @param bool $isArray
	 *
	 * @return User|User[]|null
	 */
	protected static function processObject(KornQuery $query, bool $isArray = false): User|array|null {
		$result = [];
		$firstIndex = null;

		$bind = KornStatement::getEmptyFieldsName(self::$table);
		while ($bind = $query->nextBind($bind)) {
			if (is_null($firstIndex))
				$firstIndex = $bind["u_id"];

			$result[$bind["u_id"]] = new User(
				$bind["u_id"],
				$bind["u_email"],
				$bind["u_password"],
			);
			if (!$isArray)
				return $result[$firstIndex];
		}
		if (!$isArray && count($result) == 0)
			return null;

		return $result;
	}

	public static function browse(string $query, int $limit = 15, int $offset = 0): array {
		// TODO: Implement browse() method.
		return [];
	}
	public static function remove(KYInstance|User $instance): void {
		// TODO: Implement remove() method.
	}
	public static function add(KYInstance|User $instance): int {
		$replace = new KornQueryReplace(self::$table);
		$values = [
			"u_id" => $instance->getID(),
			"u_email" => $instance->getEmail(),
			"u_password" => $instance->getPassword(),
		];
		$replace->values($values);

		$query = new KornQuery($replace);

		return $query->insertedID();
	}
	public static function get(int|null $id): User|null {
		if (array_key_exists($id, self::$getCache))
			return self::$getCache[$id];
		$select = new KornQuerySelect(self::$table);
		$select->where("u_id", $id);

		return self::$getCache[$id] = self::processObject(new KornQuery($select));
	}
	public static function getAll(): array|null {
		$select = new KornQuerySelect(self::$table);

		return self::$getCache = self::processObject(new KornQuery($select), true);
	}

	public static function getLoggedIn(): User|null {
		$user = self::isLogin();
		if (is_null($user))
			KornNetwork::redirectPage("/access-denied");

		return $user;
	}
	public static function getByEmail(string $email): User|null {
		if (array_key_exists($email, self::$getByEmailCache))
			return self::$getByEmailCache[$email];
		$select = new KornQuerySelect(self::$table);
		$select->where("u_email", $email);

		return self::$getByEmailCache[$email] = self::processObject(new KornQuery($select));
	}

	public static function login(string $email, string $password): bool {
		$user = self::getByEmail($email);
		if (is_null($user))
			return false;

		if (!password_verify($password, $user->getPassword()))
			return false;

		KornSession::set("u_id", $user->getID());

		return true;
	}
	public static function logout(): void {
		KornSession::unset("u_id");
		KornNetwork::redirectPage("/login", 1, false);
	}

	public static function isLogin(): User|null {
		if (self::$loggedIn)
			return self::$loggedIn;

		if (!KornSession::isValid("u_id"))
			return null;

		$user = self::get(KornSession::read("u_id"));
		if (!$user)
			return null;

		self::$loggedIn = $user;

		return $user;
	}
}