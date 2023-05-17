<?php

namespace libraries\kornyellow\instances;

abstract class KYInstance {
	protected int|null $id;

	public function getID(): int|null {
		return $this->id;
	}
	public function setID(int|null $id): KYInstance {
		$this->id = $id;

		return $this;
	}
}