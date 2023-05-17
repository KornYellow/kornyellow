<?php

namespace libraries\kornyellow\instances;

use libraries\korn\server\query\KornQuery;

abstract class KYMethod {
	protected static string $table;

	abstract protected static function processObject(KornQuery $query, bool $isArray = false): KYInstance|array|null;

	abstract public static function browse(string $query, int $limit = 15, int $offset = 0): array;

	abstract public static function add(KYInstance $instance): int;
	abstract public static function remove(KYInstance $instance): void;

	abstract public static function get(int|null $id): KYInstance|null;
	abstract public static function getAll(): array|null;
}