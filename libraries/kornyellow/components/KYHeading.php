<?php

namespace libraries\kornyellow\components;

class KYHeading {
	public static function level1(string $text, string $icon = null, string $secondColumn = null): string {
		if (!is_null($icon))
			$icon = '<i class="fa-solid '.$icon.' fa-fw me-3"></i>';
		else
			$icon = '';
		if (is_null($secondColumn))
			return '<h2 class="mb-4">'.$icon.$text.'</h2>';

		return '
			<div class="mb-4">
				<div class="d-flex flex-column flex-md-row">
					<div class="flex-fill">
						<h2 class="me-4 d-inline">'.$icon.$text.'</h2>
					</div>
					<div class="mt-2 mt-md-0">
						'.$secondColumn.'
					</div>
				</div>	
			</div>
		';
	}
	public static function level2(string $text, string $icon = null): string {
		if (!is_null($icon))
			$icon = '<i class="fa-solid '.$icon.' fa-fw me-3"></i>';
		else
			$icon = '';

		return '<h3 class="my-4">'.$icon.$text.'</h3>';
	}
	public static function level3(string $text): string {
		return '<h4>'.$text.'</h4>';
	}
}