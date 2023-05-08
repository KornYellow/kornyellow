<?php

namespace contents\finances\statistic;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornDateTime;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader("สถิติการเงิน");

function getIncomeGraph(): string {
	$transactionSums = [];
	$transactionSumLabels = [];

	$dateToday = new KornDateTime();

	for ($i = 0; $i < 7; $i++) {
		$transactionSums[] = KYTransaction::getIncomeByDay($dateToday, KYUser::loggedIn());

		$transactionSumLabels[] = "
			<div class='text-slate-400'>
				{$dateToday->getDate()}
			</div>
		";

		$dateToday->modifyDay(-1);
	}

	$transactionSums = array_reverse($transactionSums);
	$transactionSumLabels = array_reverse($transactionSumLabels);

	$transactionSumMax = max($transactionSums);
	$transactionSumCount = count($transactionSums);

	$power = 0.5;
	$yAxisMax = pow($transactionSumMax, $power);

	$transactionSumDisplay = "";
	foreach ($transactionSums as $index => $transactionSum) {
		$barWidth = 100 / $transactionSumCount;

		$barHeight = pow($transactionSum, $power) / $yAxisMax * 100;

		$isActive = ($transactionSum == end($transactionSums)) ? "active" : "";

		$transactionSumDisplay .= "
			<div class='d-flex flex-column align-items-center justify-content-end' style='width: $barWidth%; height: $barHeight%'>
				<div class='bar $isActive' data-bs-html='true' data-bs-toggle='tooltip' data-bs-placement='top' 
						 style='width: 100%; height: 100%' data-bs-title='฿ ".number_format($transactionSum, 2)."'></div>
				<div style='height: 0%'>$transactionSumLabels[$index]</div>
			</div>
		";
	}
	return $transactionSumDisplay;
}
function getOutcomeGraph(): string {
	$transactionSums = [];
	$transactionSumLabels = [];

	$dateToday = new KornDateTime();

	for ($i = 0; $i < 7; $i++) {
		$transactionSums[] = KYTransaction::getOutcomeByDay($dateToday, KYUser::loggedIn());

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

	$transactionSumDisplay = "";
	foreach ($transactionSums as $index => $transactionSum) {
		$barWidth = 100 / $transactionSumCount;

		$barHeight = pow($transactionSum, $power) / $yAxisMax * 100;

		$isActive = ($transactionSum == end($transactionSums)) ? "active" : "";

		$transactionSumDisplay .= "
			<div class='d-flex flex-column align-items-center justify-content-end' style='width: $barWidth%; height: $barHeight%'>
				<div class='bar $isActive' data-bs-html='true' data-bs-toggle='tooltip' data-bs-placement='top' 
						 style='width: 100%; height: 100%' data-bs-title='- ฿ ".number_format($transactionSum, 2)."'></div>
				<div style='height: 0%'>$transactionSumLabels[$index]</div>
			</div>
		";
	}
	return $transactionSumDisplay;
}

$dateToday = new KornDateTime();

?>

<section>
	<?= KYHeading::level1("สถิติการเงิน", "fa-chart-column",
		KYLink::internal("/finances", "ย้อนกลับ", "fa-rotate-left"),
	) ?>
	<div class="row g-1">
		<div class="col-12 col-lg-6">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5 mb-3">
					ภาพรวมรายจ่าย 7 วัน
				</div>
				<div class="chart-bar">
					<div class="chart-container d-flex align-items-end pb-4" style="height: 250px">
						<?= getOutcomeGraph() ?>
					</div>
				</div>
				<div class="d-flex justify-content-between mt-3">
					<div class="text-slate-300"><?= $dateToday->toStringShortThaiFormal() ?></div>
					<div class="fw-semibold fs-5 text-yellow">
						- <?= KYTransaction::getOutcomeByDay($dateToday, KYUser::loggedIn()) ?> ฿
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5 mb-3">
					ภาพรวมรายรับ 7 วัน
				</div>
				<div class="chart-bar">
					<div class="chart-container d-flex align-items-end pb-4" style="height: 250px">
						<?= getIncomeGraph() ?>
					</div>
				</div>
				<div class="d-flex justify-content-between mt-3">
					<div class="text-slate-300"><?= $dateToday->toStringShortThaiFormal() ?></div>
					<div class="fw-semibold fs-5 text-slate-300">
						<?= KYTransaction::getIncomeByDay($dateToday, KYUser::loggedIn()) ?> ฿
					</div>
				</div>
			</div>
		</div>
	</div>
</section>