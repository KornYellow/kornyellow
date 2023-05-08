<?php

namespace contents\profile;

use libraries\korn\client\KornHeader;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\instances\methods\KYUser;

KornHeader::constructHeader("จัดการบัญชีผู้ใช้");

$user = KYUser::loggedIn();

?>

<section>
	<?= KYHeading::level1("จัดการบัญชีผู้ใช้", "fa-cog",
		KYLink::internal("/logout", "ออกจากระบบ", "fa-right-from-bracket"),
	) ?>
</section>