<?php

namespace contents\finances\statistic;

use libraries\korn\client\KornHeader;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;

KornHeader::constructHeader('สถิติการเงิน');

?>

<section>
	<?= KYHeading::level1('สถิติการเงิน', 'fa-chart-column',
		KYLink::internal('/finances', 'ย้อนกลับ', 'fa-rotate-left'),
	) ?>
</section>