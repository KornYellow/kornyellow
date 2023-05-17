<?php

namespace contents\finances\category;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\korn\utils\KornIcon;
use libraries\korn\utils\KornNetwork;
use libraries\korn\utils\KornString;
use libraries\kornyellow\components\general\KYCForm;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader("แก้ไขชนิดการเงิน");

if (KornRequest::get("id")->isNull())
	KornNetwork::redirectPage("/finances/category");

$category = KYTransactionCategory::get(KornRequest::get("id")->toInteger());

if (KornRequest::post("submit")->isValid()) {
	$name = KornRequest::post("name")->toString();
	$note = KornRequest::post("note")->toString();

	$category->setName(KornString::cleanString($name));
	$category->setNote(KornString::cleanStringNullable($note));
	KYTransactionCategory::add($category);

	KornNetwork::redirectPage("/finances/category");
}

?>

<section>
	<?= KYCHeading::level1("แก้ไขชนิดการเงิน", KornIcon::penToSquare(),
		KYCLink::internal("/finances/category", "ย้อนกลับ", KornIcon::rotateLeft()),
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
		<?= KYCForm::submitButton("แก้ไขชนิดการเงิน", KornIcon::penToSquare()) ?>
	</form>
</section>
