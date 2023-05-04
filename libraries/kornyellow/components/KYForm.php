<?php

namespace libraries\kornyellow\components;

class KYForm {
	public static function isChecked(bool $isCheck): string {
		return $isCheck ? 'checked' : '';
	}
	public static function isSelected(bool $isSelect): string {
		return $isSelect ? 'selected' : '';
	}
	public static function submitButton(string $text = 'อัปเดตข้อมูล', string|null $icon = null): string {
		if (!is_null($icon))
			$icon = '<i class="fa-solid '.$icon.' me-2 fa-fw"></i>';
		return '
			<button type="submit" name="submit" class="btn btn-yellow text-nowrap fw-bold py-1 px-2" title="'.$text.'">
				'.$icon.$text.'
			</button>
		';
	}
}