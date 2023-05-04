<?php

namespace contents\finances\category;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\korn\utils\KornNetwork;
use libraries\korn\utils\KornString;
use libraries\kornyellow\components\KYForm;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader('แก้ไขชนิดการเงิน');

if (KornRequest::get('id')->isNull())
	KornNetwork::redirectPage('/finances/category');

$category = KYTransactionCategory::get(KornRequest::get('id')->toInteger());

if (KornRequest::post('submit')->isValid()) {
	$name = KornRequest::post('name')->toString();
	$note = KornRequest::post('note')->toString();

	$category->setName(KornString::cleanString($name));
	$category->setNote(KornString::cleanStringNullable($note));
	KYTransactionCategory::add($category);

	KornNetwork::redirectPage('/finances/category');
}

?>

<section>
	<?= KYHeading::level1('แก้ไขชนิดการเงิน', 'fa-pen-to-square',
		KYLink::internal('/finances/category', 'ย้อนกลับ', 'fa-rotate-left'),
	) ?>
	<form method="post">
		<div class="mb-3">
			<label for="name" class="form-label">ชื่อรายการ</label>
			<input type="text" required class="form-control" name="name" id="name"
			       placeholder="อาหาร, ท่องเที่ยว, ของขวัญ" autocomplete="off" value="<?= $category->getName() ?>"/>
		</div>
		<div class="mb-3">
			<label for="note" class="form-label">เตือนความจำ</label>
			<textarea class="form-control" name="note" id="note" placeholder="บันทึกเพิ่มเติม..."
			          autocomplete="off"><?= $category->getNote() ?></textarea>
			<div class="form-text">เราจะไม่เผยแพร่ข้อมูลของคุณกับผู้อื่น</div>
		</div>
		<?= KYForm::submitButton('แก้ไขชนิดการเงิน', 'fa-pen-to-square') ?>
	</form>
</section>
