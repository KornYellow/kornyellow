<?php

namespace templates\errors;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;

KornHeader::constructHeader("ข้อผิดพลาด 404 ...");

$icons = "";
$fontAwesomeIcons = KornIcon::getAll();
foreach ($fontAwesomeIcons as $fontAwesomeIcon) {
	$icons .= "
		<div class='col-2 text-center'>
			<div>".($fontAwesomeIcon->xl())."</div>
			<small>".($fontAwesomeIcon->getIconName())."</small>
		</div>
	";
}

?>

<section>
	<?= KYCHeading::level1("หาหน้าเว็บที่คุณต้องการไม่เจอครับ", KornIcon::exclamation()) ?>
	<p>ลองหน้าอื่นไหมครับ หรือว่าพิมพ์ลิ้งก์ผิด และหากต้องการกลับไปหน้าหลักก็กดปุ่มด้านล่างได้เลยครับ</p>
	<?= KYCLink::internal("/", "กลับหน้าหลัก", KornIcon::rotateLeft()) ?>
	<div class="row g-2 gy-4">
		<?= $icons ?>
	</div>
</section>