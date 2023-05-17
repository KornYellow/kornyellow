<?php

namespace kornyellow\contents\finances\category;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Client\KornRequest;
use KornyellowLib\Utils\KornIcon;
use KornyellowLib\Utils\KornNetwork;
use KornyellowLib\Utils\KornString;
use libraries\kornyellow\components\general\KYCForm;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\instances\classes\transaction\TransactionCategory;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader("เพิ่มชนิดการเงิน");

if (KornRequest::post("submit")->isValid()) {
	$name = KornRequest::post("name")->toString();
	$note = KornRequest::post("note")->toString();

	KYTransactionCategory::add(new TransactionCategory(
		null,
		KYUser::getLoggedIn(),
		KornString::cleanString($name),
		KornString::cleanStringNullable($note)
	));

	KornNetwork::redirectPage("/finances/category");
}

?>

<section>
	<?= KYCHeading::level1("เพิ่มชนิดการเงิน", KornIcon::plus(),
		KYCLink::internal("/finances/category", "ย้อนกลับ", KornIcon::rotateLeft()),
	) ?>
	<form method="post">
		<div class="mb-3">
			<label for="name" class="form-label">ชื่อรายการ</label>
			<input type="text" required class="form-control" name="name" id="name" placeholder="อาหาร, ท่องเที่ยว, ของขวัญ"
			       autocomplete="off"/>
		</div>
		<div class="mb-3">
			<label for="note" class="form-label">เตือนความจำ</label>
			<textarea class="form-control" name="note" id="note" placeholder="บันทึกเพิ่มเติม..."
			          autocomplete="off"></textarea>
			<div class="form-text">เราจะไม่เผยแพร่ข้อมูลของคุณกับผู้อื่น</div>
		</div>
		<?= KYCForm::submitButton("เพิ่มชนิดการเงิน", KornIcon::plus()) ?>
	</form>
</section>
