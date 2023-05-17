<?php

namespace contents\profile;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\instances\methods\KYUser;

KornHeader::constructHeader("จัดการบัญชีผู้ใช้");

$user = KYUser::getLoggedIn();

?>

<section>
	<?= KYCHeading::level1("จัดการบัญชีผู้ใช้", KornIcon::cog(),
		KYCLink::internal("/logout", "ออกจากระบบ", KornIcon::rightFromBracket()),
	) ?>
</section>