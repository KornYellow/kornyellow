<?php

namespace contents;

use libraries\korn\client\KornHeader;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\instances\methods\KYUser;

KornHeader::constructHeader('ออกจากระบบ...');

KYUser::logout();

?>

<section>
	<?= KYHeading::level1('กำลังออกจากระบบ ...', 'fa-spinner fa-spin') ?>
</section>