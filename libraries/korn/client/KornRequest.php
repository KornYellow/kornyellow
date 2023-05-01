<?php

namespace libraries\korn\client;

class KornRequest {
	public static function get($name): KornRequestValue {
		return isset($_GET[$name])
			? new KornRequestValue($_GET[$name])
			: new KornRequestValue(null);
	}
	public static function post($name): KornRequestValue {
		return isset($_POST[$name])
			? new KornRequestValue($_POST[$name])
			: new KornRequestValue(null);
	}
}
