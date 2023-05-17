<?php

namespace kornyellow\contents;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;

KornHeader::constructHeader("ระบบไม่อนุญาติให้คุณเข้าส่วนนี้ ...");

?>

<section>
	<?= KYCHeading::level1("ระบบไม่อนุญาติให้คุณเข้าส่วนนี้ ...", KornIcon::hand()) ?>
	<p>ลองหน้าอื่นไหมครับ หรือว่าพิมพ์ลิ้งก์ผิด และหากต้องการกลับไปหน้าหลักก็กดปุ่มด้านล่างได้เลยครับ</p>
	<?= KYCLink::internal("/", "กลับหน้าหลัก", KornIcon::rotateLeft()) ?>
</section>