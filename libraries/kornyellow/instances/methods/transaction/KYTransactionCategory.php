<?php

namespace libraries\kornyellow\instances\methods\transaction;

use libraries\korn\server\query\builder\KornQueryReplace;
use libraries\korn\server\query\builder\KornQuerySelect;
use libraries\korn\server\query\KornQuery;
use libraries\korn\server\query\KornStatement;
use libraries\kornyellow\instances\classes\transaction\TransactionCategory;
use libraries\kornyellow\instances\classes\User;
use libraries\kornyellow\instances\KYInstance;
use libraries\kornyellow\instances\KYMethod;
use libraries\kornyellow\instances\methods\KYUser;

class KYTransactionCategory extends KYMethod {
	protected static string $table = "transaction_category";
	protected static array $getCache = [];
	protected static array $getByUserCache = [];

	/**
	 * @param KornQuery $query
	 * @param bool $isArray
	 *
	 * @return TransactionCategory|TransactionCategory[]|null
	 */
	protected static function processObject(KornQuery $query, bool $isArray = false): TransactionCategory|array|null {
		$result = [];
		$firstIndex = null;

		$bind = KornStatement::getEmptyFieldsName(self::$table);
		while ($bind = $query->nextBind($bind)) {
			if (is_null($firstIndex))
				$firstIndex = $bind["tc_id"];
			$result[$bind["tc_id"]] = new TransactionCategory(
				$bind["tc_id"],
				KYUser::get($bind["tc_u_id"]),
				$bind["tc_name"],
				$bind["tc_note"]
			);
			if (!$isArray)
				return $result[$firstIndex];
		}
		if (count($result) == 0)
			return null;

		return $result;
	}

	public static function browse(string $query, int $limit = 15, int $offset = 0): array {
		// TODO: Implement browse() method.
		return [];
	}
	public static function remove(KYInstance $instance): void {
		// TODO: Implement remove() method.
	}
	public static function add(KYInstance|TransactionCategory $instance): int {
		$replace = new KornQueryReplace(self::$table);
		$values = [
			"tc_id" => $instance->getID(),
			"tc_u_id" => $instance->getUser()->getID(),
			"tc_name" => $instance->getName(),
			"tc_amount" => $instance->getNote(),
		];
		$replace->values($values);

		$query = new KornQuery($replace);

		return $query->insertedID();
	}
	public static function get(int|null $id): TransactionCategory|null {
		if (array_key_exists($id, self::$getCache))
			return self::$getCache[$id];
		$select = new KornQuerySelect(self::$table);
		$select->where("tc_id", $id);

		return self::$getCache[$id] = self::processObject(new KornQuery($select));
	}
	public static function getAll(): array|null {
		$select = new KornQuerySelect(self::$table);

		return self::$getCache = self::processObject(new KornQuery($select), true);
	}

	public static function getByUser(User $user): array|null {
		if (array_key_exists($user->getID(), self::$getByUserCache))
			return self::$getByUserCache[$user->getID()];
		$select = new KornQuerySelect(self::$table);
		$select->where("tc_u_id", $user->getID());

		return self::$getByUserCache[$user->getID()] = self::processObject(new KornQuery($select), true);
	}
}