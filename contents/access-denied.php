<?php

namespace contents;

use libraries\korn\client\KornHeader;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;

KornHeader::constructHeader("ระบบไม่อนุญาติให้คุณเข้าส่วนนี้ ...");

?>

<section>
	<?= KYHeading::level1("ระบบไม่อนุญาติให้คุณเข้าส่วนนี้ ...", "fa-hand") ?>
	<p>ลองหน้าอื่นไหมครับ หรือว่าพิมพ์ลิ้งก์ผิด และหากต้องการกลับไปหน้าหลักก็กดปุ่มด้านล่างได้เลยครับ</p>
	<?= KYLink::internal("/", "กลับหน้าหลัก", "fa-rotate-left") ?>
</section>