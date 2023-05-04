<?php

namespace contents\blogs;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;

KornHeader::constructHeader('จัดการบทความ');

$blog_status = KornRequest::get('blog_status')->toString();

?>

<section>
	<?= KYHeading::level1('จัดการบทความ', null,
		KYLink::internal('/blogs/create', 'เขียนบทความใหม่'),
	) ?>

	<div class="d-flex gap-2">
		<div><?= KYLink::internal('/blogs/manage', 'ทั้งหมด', $blog_status == '') ?></div>
		|
		<div><?= KYLink::internal('/blogs/manage?blog_status=published', 'เผยแพร่แล้ว', $blog_status == 'published') ?></div>
		|
		<div><?= KYLink::internal('/blogs/manage?blog_status=draft', 'แบบร่าง', $blog_status == 'draft') ?></div>
		|
		<div><?= KYLink::internal('/blogs/manage?blog_status=trashed', 'ถังขยะ', $blog_status == 'trashed') ?></div>
	</div>
</section>
