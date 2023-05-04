<?php

namespace libraries\kornyellow\components;

class KYHeading {
	public static function level1(string $text, string $icon = null, string ...$options): string {
		$icon = is_null($icon) ? '' : '<i class="fa-solid '.$icon.' fa-fw me-2 me-lg-3"></i>';

		if (count($options) == 0) {
			return '
				<h2 class="mb-3 d-flex">
					'.$icon.$text.'
				</h2>
			';
		}

		$secondColumn = '';
		foreach ($options as $option)
			$secondColumn .= '<div class="col-12 col-md-auto">'.$option.'</div>';

		return '
			<div class="mb-3">
				<div class="d-flex flex-column flex-md-row">
					<div class="flex-fill">
						<h2 class="me-4 d-flex">
							'.$icon.$text.'
						</h2>
					</div>
					<div class="mt-1 mt-md-0">
						<div class="row g-1">
							'.$secondColumn.'
						</div>
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

		return '
			<h3 class="my-3 d-flex">
				'.$icon.$text.'
			</h3>
		';
	}
	public static function level3(string $text): string {
		return '<h4>'.$text.'</h4>';
	}
}