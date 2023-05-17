<?php

namespace contents\blogs;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;

KornHeader::constructHeader("จัดการบทความ");

$blog_status = KornRequest::get("blog_status")->toString();

?>

<section>
	<?= KYCHeading::level1("จัดการบทความ", null,
		KYCLink::internal("/blogs/create", "เขียนบทความใหม่"),
	) ?>

</section>
