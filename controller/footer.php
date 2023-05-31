<?php

namespace kornyellow\controller;

use KornyellowLib\Utils\KornDateTime;
use KornyellowLib\Utils\KornNetwork;
use KornyellowLib\Utils\KornPerformance;

$measureTime = "
	<div class='d-flex flex-column flex-lg-row gap-0 gap-lg-2'>
		<small>ใช้เวลาโหลด ".KornPerformance::getMeasuredLoadTime()." วินาที</small>
		<small>ใช้คำสั่งทั้งหมด ".KornPerformance::getQueryCountMeasured()." คำสั่ง</small>
	</div>
";

if (!KornNetwork::isLocalHost())
	$measureTime = "<div></div>";

echo "
</main>

<footer class='flex-shrink-0 p-0 p-md-1'>
	<div class='container'>
		<div class='d-flex flex-column flex-lg-row justify-content-between text-slate-400'>
			$measureTime
			<div class='text-nowrap text-truncate'><small>Copyright © ".(new KornDateTime())->getYear()." kornyellow.com</small></div>
		</div>
	</div>
</footer>

</body>
</html>
";