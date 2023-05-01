<?php

namespace libraries\kornyellow\components;

class KYLink {
	public static function external(string $href, string $text): string {
		return '<a class="text-nowrap fw-semibold text-yellow" rel="noopener" title="'.$text.'" href="'.$href.'" target="_blank">'.$text.'</a>';
	}
	public static function internal(string $href, string $text, string $icon = null): string {
		if (!is_null($icon))
			$icon = '<i class="fa-solid '.$icon.' fa-fw me-2"></i>';
		else
			$icon = '';

		return '<a class="btn btn-yellow text-nowrap fw-bold" title="'.$text.'" href="'.$href.'">'.$icon.$text.'</a>';
	}
}