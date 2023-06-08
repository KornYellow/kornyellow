<?php

namespace libraries\kornyellow\components\general;

use KornyellowLib\Utils\KornIcon;

class KYCLink {
	public static function external(string $href, string $text): string {
		return "
			<a class='text-nowrap fw-semibold text-yellow' rel='noopener' title='$text' href='$href' target='_blank'>
				$text
			</a>
		";
	}
	public static function internal(string $href, string $text, KornIcon $icon = null): string {
		if (is_null($icon)) $icon = "";
		else $icon->me1()->nofw()->more("me-md-2");

		return "
			<a class='btn btn-yellow text-nowrap fw-bold py-0 px-2 py-md-1 px-md-2' title='$text' href='$href'>
				<div class='d-none d-md-block'>$icon$text</div>
				<div class='d-block d-md-none'><small>$icon$text</small></div>
			</a>
		";
	}
}