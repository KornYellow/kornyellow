<?php

namespace templates\errors;

use libraries\korn\client\KornHeader;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;

KornHeader::constructHeader('ข้อผิดพลาด 404 ...');

?>

<section>
	<?= KYHeading::level1('หาหน้าเว็บที่คุณต้องการไม่เจอครับ', 'fa-exclamation') ?>
	<p>ลองหน้าอื่นไหมครับ หรือว่าพิมพ์ลิ้งก์ผิด และหากต้องการกลับไปหน้าหลักก็กดปุ่มด้านล่างได้เลยครับ</p>
	<?= KYLink::internal('/', 'กลับหน้าหลัก', 'fa-rotate-left') ?>
</section>