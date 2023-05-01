<?php

namespace templates;

use libraries\korn\utils\KornDateTime;
use libraries\korn\utils\KornNetwork;
use libraries\korn\utils\KornPerformance;

$measureTime = '<div><small>ใช้เวลาโหลด '.KornPerformance::getMeasuredLoadTime().' วินาที ใช้คำสั่งทั้งหมด '.KornPerformance::getQueryCountMeasured().' คำสั่ง</small></div>';
if (!KornNetwork::isLocalHost())
	$measureTime = '<div></div>';

echo '
</main>

<footer class="flex-shrink-0 p-1">
	<div class="container">
		<div class="d-flex justify-content-between text-slate-400">
			'.$measureTime.'
			<div class="text-nowrap text-truncate"><small>Copyright © '.(new KornDateTime())->getYear().' kornyellow.com</small></div>
		</div>
	</div>
</footer>

</body>
</html>
';