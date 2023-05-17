<?php

namespace libraries\kornyellow\instances\classes\transaction;

use libraries\kornyellow\instances\classes\User;
use libraries\kornyellow\instances\KYInstance;

class TransactionCategory extends KYInstance {
	public function __construct(
		protected int|null  $id,
		private User        $user,
		private string      $name,
		private string|null $note,
	) {}

	public function getUser(): User {
		return $this->user;
	}
	public function setUser(User $user): TransactionCategory {
		$this->user = $user;

		return $this;
	}

	public function getName(): string {
		return $this->name;
	}
	public function setName(string $name): TransactionCategory {
		$this->name = $name;

		return $this;
	}

	public function getNote(): string|null {
		return $this->note;
	}
	public function setNote(string|null $note): TransactionCategory {
		$this->note = $note;

		return $this;
	}
}