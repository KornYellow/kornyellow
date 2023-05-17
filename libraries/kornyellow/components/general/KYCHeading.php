<?php

namespace libraries\kornyellow\components\general;

use KornyellowLib\Utils\KornIcon;

class KYCHeading {
	public static function level1(string $text, KornIcon $icon = null, string ...$options): string {
		if (is_null($icon)) $icon = "";
		else $icon->me2()->more("me-lg-3");

		if (count($options) == 0) {
			return "
				<h2 class='mb-3 d-flex'>
					$icon$text
				</h2>
			";
		}

		$secondColumn = "";
		foreach ($options as $option)
			$secondColumn .= "<div class='col-12 col-md-auto'>$option</div>";

		return "
			<div class='mb-3'>
				<div class='d-flex flex-column flex-md-row'>
					<div class='flex-fill'>
						<h2 class='me-4 d-flex'>$icon$text</h2>
					</div>
					<div class='mt-1 mt-md-0'>
						<div class='row g-1'>$secondColumn</div>
					</div>
				</div>	
			</div>
		";
	}
	public static function level2(string $text, KornIcon $icon = null): string {
		if (is_null($icon)) $icon = "";
		else $icon->me3();

		return "
			<h3 class='my-3 d-flex'>
				$icon$text
			</h3>
		";
	}
	public static function level3(string $text): string {
		return "<h4>$text</h4>";
	}
}