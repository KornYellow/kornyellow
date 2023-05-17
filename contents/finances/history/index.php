<?php

namespace kornyellow\contents\finances\history;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Client\KornRequest;
use KornyellowLib\Utils\KornDateTime;
use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\components\KYCTransaction;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader("ประวัติการเงิน");

$transactionsDisplay = "";

// TODO: Refactoring Code

function getByDays(int $dayCount, KornDateTime $startDay = new KornDateTime()): string {
	$isFirstOne = true;
	$transactionsDisplay = "";
	for ($i = 0; $i < $dayCount; $i++) {
		$transactions = KYTransaction::getByDay($startDay, KYUser::getLoggedIn());
		if (!is_null($transactions)) {
			$marginTop = "mt-4";
			if ($isFirstOne)
				$marginTop = "mt-1";
			$isFirstOne = false;
			$transactionsDisplay .= "
				<div class='col-12 fw-semibold fs-6 fs-sm-5 text-slate-400 mb-n2 mb-sm-n1 $marginTop'>
					{$startDay->toStringShortThai()}
				</div>
			";
			$transactionsDisplay .= KYCTransaction::getHistoryBars($transactions);
		}
		$startDay->modifyDay(-1);
	}

	return $transactionsDisplay;
}

$request = KornRequest::get("timespan");
$requestText = null;
$transactionHeader = "ภายในเจ็ดวันที่ผ่านมา";
$transactionsDisplay = getByDays(7);

if ($request->isValid()) {
	$requestText = $request->toString();
	$dateToday = KornDateTime::now();

	if ($requestText == "lastmonth") {
		$transactionHeader = "ภายในเดือนที่แล้ว";
		$dateMonth = KornDateTime::now();
		$dateMonth = $dateMonth->modifyMonth(-1);
		$dateToday = $dateToday->modifyMonth(-1);

		$dateCount = 0;
		while ($dateToday->getMonth() == $dateMonth->getMonth()) {
			$dateMonth->modifyDay(1);
			$dateCount++;
		}

		while ($dateToday->getDate() != $dateCount)
			$dateToday->modifyDay(1);

		$transactionsDisplay = getByDays($dateCount, $dateToday);

	} else if ($requestText == "thismonth") {
		$transactionHeader = "ภายในเดือนนี้";
		$dateMonth = KornDateTime::now();

		while ($dateMonth->getDate() != 1)
			$dateMonth->modifyDay(-1);

		$dateCount = 0;
		while ($dateToday->getMonth() == $dateMonth->getMonth()) {
			$dateMonth->modifyDay(1);
			$dateCount++;
		}

		while ($dateToday->getDate() != $dateCount)
			$dateToday->modifyDay(1);

		$transactionsDisplay = getByDays($dateCount, $dateToday);

	} else if ($requestText == "fourteendays") {
		$transactionHeader = "ภายในสิบสี่วันที่ผ่านมา";
		$transactionsDisplay = getByDays(14);
	}
}

?>

<section>
	<?= KYCHeading::level1("ประวัติการเงิน", KornIcon::clockRotateLeft(),
		KYCLink::internal("/finances", "ย้อนกลับ", KornIcon::rotateLeft()),
	) ?>
	<div class="row g-2 mb-3">
		<div class="col-12">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5">
					<?= KornIcon::wallet()->me1()->more("text-yellow") ?>
					เงินคงเหลือ
				</div>
				<div class="fs-3">
					<span>฿</span>
					<span class="fw-semibold">
						<?= number_format(KYTransaction::reCalculateBalance(KYUser::getLoggedIn()), 2) ?>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-5">
		<form method="get" autocomplete="off">
			<div class="d-flex gap-2 overflow-x-scroll">
				<button name="timespan" value="sevendays" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= is_null($requestText) || $requestText == "sevendays" ? "active" : "" ?>">
					ภายในเจ็ดวันที่ผ่านมา
				</button>
				<button name="timespan" value="fourteendays" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= $requestText == "fourteendays" ? "active" : "" ?>">
					ภายในสิบสี่วันที่ผ่านมา
				</button>
				<button name="timespan" value="thismonth" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= $requestText == "thismonth" ? "active" : "" ?>">
					ภายในเดือนนี้
				</button>
				<button name="timespan" value="lastmonth" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= $requestText == "lastmonth" ? "active" : "" ?>">
					ภายในเดือนที่แล้ว
				</button>
			</div>
		</form>
	</div>
	<?= KYCHeading::level2($transactionHeader) ?>
	<div class="row g-2">
		<?= $transactionsDisplay ?>
	</div>
</section>