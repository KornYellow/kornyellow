<?php

namespace libraries\kornyellow\instances\classes;

use libraries\kornyellow\instances\KYInstance;

class User extends KYInstance {
	public function __construct(
		protected int|null $id,
		private string     $email,
		private string     $password,
		private float      $amountCached,
	) {}

	public function getEmail(): string {
		return $this->email;
	}
	public function setEmail(string $email): User {
		$this->email = $email;
		return $this;
	}

	public function getPassword(): string {
		return $this->password;
	}
	public function setPassword(string $password): User {
		$this->password = $password;
		return $this;
	}

	public function getAmountCached(): float {
		return $this->amountCached;
	}
	public function setAmountCached(float $amountCached): User {
		$this->amountCached = $amountCached;
		return $this;
	}
}