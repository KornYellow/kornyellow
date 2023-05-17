<?php

namespace libraries\kornyellow\instances\classes\transaction;

use KornyellowLib\Utils\KornDateTime;
use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\classes\User;
use libraries\kornyellow\instances\KYInstance;

class Transaction extends KYInstance {
	public function __construct(
		protected int|null               $id,
		private User                     $user,
		private TransactionCategory|null $transactionCategory,
		private string                   $name,
		private string|null              $note,
		private EnumTransactionType      $transactionType,
		private float                    $amount,
		private KornDateTime             $dateTime,
	) {}

	public function getUser(): User {
		return $this->user;
	}
	public function setUser(User $user): Transaction {
		$this->user = $user;

		return $this;
	}

	public function getTransactionCategory(): TransactionCategory|null {
		return $this->transactionCategory;
	}
	public function setTransactionCategory(TransactionCategory|null $transactionCategory): Transaction {
		$this->transactionCategory = $transactionCategory;

		return $this;
	}

	public function getName(): string {
		return $this->name;
	}
	public function setName(string $name): Transaction {
		$this->name = $name;

		return $this;
	}

	public function getNote(): string|null {
		return $this->note;
	}
	public function setNote(string|null $note): Transaction {
		$this->note = $note;

		return $this;
	}

	public function getTransactionType(): EnumTransactionType {
		return $this->transactionType;
	}
	public function setTransactionType(EnumTransactionType $transactionType): Transaction {
		$this->transactionType = $transactionType;

		return $this;
	}

	public function getDateTime(): KornDateTime {
		return $this->dateTime;
	}
	public function setDateTime(KornDateTime $dateTime): Transaction {
		$this->dateTime = $dateTime;

		return $this;
	}

	public function getAmount(): float {
		return $this->amount;
	}
	public function setAmount(float $amount): Transaction {
		$this->amount = $amount;

		return $this;
	}
}