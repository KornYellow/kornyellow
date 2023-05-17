<?php

namespace contents;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\instances\methods\KYUser;

KornHeader::constructHeader("ออกจากระบบ...");

KYUser::logout();

?>

<section>
	<?= KYCHeading::level1("กำลังออกจากระบบ ...", KornIcon::spinner()->more("fa-spin")) ?>
</section>