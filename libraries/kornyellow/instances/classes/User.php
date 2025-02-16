<?php

namespace libraries\kornyellow\instances\classes;

use libraries\kornyellow\instances\KYInstance;

class User extends KYInstance {
	public function __construct(
		protected int|null $id,
		private string     $email,
		private string     $password,
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
}