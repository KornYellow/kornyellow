<?php

namespace kornyellow\contents\finances\statistic;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Utils\KornDateTime;
use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\components\KYCTransaction;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader("สถิติการเงิน");

function getOutcomeGraph(): string {
	$transactionSums = [];
	$transactionSumLabels = [];

	$dateToday = KornDateTime::now();

	for ($i = 0; $i < 7; $i++) {
		$transactionSums[] = KYTransaction::getOutcomeByDay($dateToday, KYUser::getLoggedIn());

		$transactionSumLabels[] = "
			<div class='text-slate-400'>{$dateToday->getDate()}</div>
		";

		$dateToday->modifyDay(-1);
	}

	$transactionSums = array_reverse($transactionSums);
	$transactionSumLabels = array_reverse($transactionSumLabels);

	$transactionSumMax = max($transactionSums);
	$transactionSumCount = count($transactionSums);

	$power = 0.5;
	$yAxisMax = pow($transactionSumMax, $power);
	if ($yAxisMax == 0)
		$yAxisMax = 1;

	$transactionSumDisplay = "";
	foreach ($transactionSums as $index => $transactionSum) {
		$barWidth = 100 / $transactionSumCount;

		$barHeight = pow($transactionSum, $power) / $yAxisMax * 100;

		$isActive = ($transactionSum == end($transactionSums)) ? "active" : "";

		$transactionSumDisplay .= "
			<div class='d-flex flex-column align-items-center justify-content-end' style='width: $barWidth%; height: $barHeight%'>
				<div class='bar $isActive' data-bs-html='true' data-bs-toggle='tooltip' data-bs-placement='top' 
						 style='width: 100%; height: 100%' data-bs-title='- ฿ ".number_format($transactionSum, 2)."'></div>
				<div style='height: 0'>$transactionSumLabels[$index]</div>
			</div>
		";
	}

	return $transactionSumDisplay;
}

$dateToday = KornDateTime::now();

$transactions = KYTransaction::getByDay($dateToday, KYUser::getLoggedIn());
$transactionsDisplay = KYCTransaction::getHistoryBars($transactions);

if (empty($transactionsDisplay))
	$transactionsDisplay = KYCTransaction::historyEmpty();

?>

<section>
	<?= KYCHeading::level1("สถิติการเงิน", KornIcon::chartColumn(),
		KYCLink::internal("/finances", "ย้อนกลับ", KornIcon::rotateLeft()),
	) ?>
	<div class="row g-3">
		<div class="col-12 col-lg-6">
			<?= KYCHeading::level2("ภาพรวมรายจ่าย", null,
				KYCLink::internal("/finances/statistic/all", "ดูเพิ่มเติม", KornIcon::bars()),
			) ?>
			<div class="mt-n3 text-slate-400 mb-3">
				<div><?= $dateToday->toStringShortThaiFormal() ?></div>
			</div>
			<div class="chart-bar text-nowrap">
				<div class="chart-container d-flex align-items-end pb-4 gap-2" style="height: 250px">
					<?= getOutcomeGraph() ?>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<?= KYCHeading::level2("ยอดรายจ่ายล่าสุด") ?>
			<div class="mt-n3 text-slate-400 mb-3">
				วันนี้คุณใช้จ่ายไป
				฿<?= number_format(KYTransaction::getOutcomeByDay($dateToday, KYUser::getLoggedIn()), 2) ?> บาท
			</div>
			<div class="row g-2">
				<?= $transactionsDisplay ?>
			</div>
		</div>
	</div>
</section>