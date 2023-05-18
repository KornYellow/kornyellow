<?php

namespace libraries\kornyellow\instances\methods\transaction;

use KornyellowLib\Server\Query\Builder\KornQueryDelete;
use KornyellowLib\Server\Query\Builder\KornQueryReplace;
use KornyellowLib\Server\Query\Builder\KornQuerySelect;
use KornyellowLib\Server\Query\KornQuery;
use KornyellowLib\Server\Query\KornStatement;
use KornyellowLib\Utils\KornDateTime;
use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\classes\transaction\Transaction;
use libraries\kornyellow\instances\classes\User;
use libraries\kornyellow\instances\KYInstance;
use libraries\kornyellow\instances\KYMethod;
use libraries\kornyellow\instances\methods\KYUser;

class KYTransaction extends KYMethod {
	protected static string $table = "transaction";
	protected static array $getCache = [];

	/**
	 * @param KornQuery $query
	 * @param bool $isArray
	 *
	 * @return Transaction|Transaction[]|null
	 */
	protected static function processObject(KornQuery $query, bool $isArray = false): Transaction|array|null {
		$result = [];
		$firstIndex = null;

		$bind = KornStatement::getEmptyFieldsName(self::$table);
		while ($bind = $query->nextBind($bind)) {
			if (is_null($firstIndex))
				$firstIndex = $bind["t_id"];

			$result[$bind["t_id"]] = new Transaction(
				$bind["t_id"],
				KYUser::get($bind["t_u_id"]),
				KYTransactionCategory::get($bind["t_tc_id"]),
				$bind["t_name"],
				$bind["t_note"],
				EnumTransactionType::create($bind["t_type"]),
				$bind["t_amount"],
				new KornDateTime($bind["t_datetime"]),
			);

			if (!$isArray)
				return $result[$firstIndex];
		}

		return $result;
	}

	public static function browse(string $query, int $limit = 15, int $offset = 0): array {
		// TODO: Implement browse() method.
		return [];
	}
	public static function remove(KYInstance $instance): void {
		$remove = new KornQueryDelete(self::$table);
		$remove->where("t_id", $instance->getID());

		KornQuery::execute($remove);
	}
	public static function add(KYInstance|Transaction $instance): int {
		$replace = new KornQueryReplace(self::$table);
		$values = [
			"t_id" => $instance->getID(),
			"t_u_id" => $instance->getUser()->getID(),
			"t_tc_id" => $instance->getTransactionCategory()?->getID(),
			"t_name" => $instance->getName(),
			"t_note" => $instance->getNote(),
			"t_type" => $instance->getTransactionType()->getID(),
			"t_amount" => $instance->getAmount(),
			"t_datetime" => $instance->getDateTime()->toMySQLDateTime(),
		];
		$replace->values($values);

		$query = new KornQuery($replace);

		return $query->insertedID();
	}
	public static function get(int|null $id): Transaction|null {
		if (array_key_exists($id, self::$getCache))
			return self::$getCache[$id];
		$select = new KornQuerySelect(self::$table);
		$select->where("t_id", $id);

		return self::$getCache[$id] = self::processObject(new KornQuery($select));
	}
	public static function getAll(): array|null {
		$select = new KornQuerySelect(self::$table);

		return self::$getCache = self::processObject(new KornQuery($select), true);
	}
	public static function reCalculateBalance(User $user): float {
		$transactions = self::getAll();
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::INCOME()))
				$balance += $transaction->getAmount();
			else
				$balance -= $transaction->getAmount();
		}

		return $balance;
	}

	public static function getIncomeByDay(KornDateTime $day, User $user): float {
		$transactions = self::getByDay($day, $user);
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::INCOME()))
				$balance += $transaction->getAmount();
		}

		return $balance;
	}
	public static function getIncomeByMonth(KornDateTime $month, User $user): float {
		$transactions = self::getByMonth($month, $user);
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::INCOME()))
				$balance += $transaction->getAmount();
		}

		return $balance;
	}
	public static function getIncomeByYear(KornDateTime $year, User $user): float {
		$transactions = self::getByYear($year, $user);
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::INCOME()))
				$balance += $transaction->getAmount();
		}

		return $balance;
	}

	public static function getOutcomeByDay(KornDateTime $day, User $user): float {
		$transactions = self::getByDay($day, $user);
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()))
				$balance += $transaction->getAmount();
		}

		return $balance;
	}
	public static function getOutcomeByMonth(KornDateTime $month, User $user): float {
		$transactions = self::getByMonth($month, $user);
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()))
				$balance += $transaction->getAmount();
		}

		return $balance;
	}
	public static function getOutcomeByYear(KornDateTime $year, User $user): float {
		$transactions = self::getByYear($year, $user);
		if (is_null($transactions))
			return 0;
		$balance = 0;
		foreach ($transactions as $transaction) {
			if ($transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()))
				$balance += $transaction->getAmount();
		}

		return $balance;
	}

	public static function getByDay(KornDateTime $day, User $user): array|null {
		$select = new KornQuerySelect(self::$table);
		$select->whereDateInDay("t_datetime", $day);
		$select->whereAnd();
		$select->where("t_u_id", $user->getID());
		$select->sortByColumn("t_datetime");
		$select->sortDescending();

		return self::processObject(new KornQuery($select), true);
	}
	public static function getByMonth(KornDateTime $month, User $user): array|null {
		$select = new KornQuerySelect(self::$table);
		$select->whereDateInMonth("t_datetime", $month);
		$select->whereAnd();
		$select->where("t_u_id", $user->getID());
		$select->sortByColumn("t_datetime");
		$select->sortDescending();

		return self::processObject(new KornQuery($select), true);
	}
	public static function getByYear(KornDateTime $year, User $user): array|null {
		$select = new KornQuerySelect(self::$table);
		$select->whereDateInYear("t_datetime", $year);
		$select->whereAnd();
		$select->where("t_u_id", $user->getID());
		$select->sortByColumn("t_datetime");
		$select->sortDescending();

		return self::processObject(new KornQuery($select), true);
	}

}