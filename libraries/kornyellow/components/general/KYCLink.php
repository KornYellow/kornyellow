<?php

namespace libraries\kornyellow\components\general;

use libraries\korn\utils\KornIcon;

class KYCLink {
	public static function external(string $href, string $text): string {
		return "<a class='text-nowrap fw-semibold text-yellow' rel='noopener' title='$text' href='$href' target='_blank'>$text</a>";
	}
	public static function internal(string $href, string $text, KornIcon $icon = null): string {
		if (is_null($icon)) $icon = "";
		else $icon->me2()->nofw();

		return "<a class='btn btn-yellow text-nowrap fw-bold py-1 px-2' title='$text' href='$href'>$icon$text</a>";
	}
}