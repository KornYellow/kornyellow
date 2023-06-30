<?php

namespace kornyellow\controller;

use KornyellowLib\Utils\KornDateTime;
use KornyellowLib\Utils\KornIcon;
use KornyellowLib\Utils\KornNetwork;
use KornyellowLib\Utils\KornPerformance;
use libraries\kornyellow\components\general\KYCScript;

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
			<div class='text-nowrap text-truncate'><small>Copyright © ".(KornDateTime::now())->getYear()." kornyellow.com</small></div>
		</div>
	</div>
</footer>
<div class='d-none back-to-top fixed-bottom d-flex justify-content-end pe-3 pb-3'>
	<a href='#' class='text-slate-200 p-3 pb-2 rounded-5 bg-slate-600'>
		".(KornIcon::caretUp()->xl())."
	</a>
</div>

</body>
</html>
";

if (KYCScript::isTransactionEnable())
	include "static/kornyellow/js/transaction.php";