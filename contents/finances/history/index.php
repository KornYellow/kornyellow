<?php

namespace contents\finances\history;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\korn\utils\KornDateTime;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\components\KYTransactionHistory;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader('ประวัติการเงิน');

$transactionsDisplay = '';

function getByDays(int $dayCount, KornDateTime $startDay = new KornDateTime()): string {
	$transactionsDisplay = '';
	for ($i = 0; $i < $dayCount; $i++) {
		$transactions = KYTransaction::getByDay($startDay, KYUser::loggedIn());
		if (!is_null($transactions)) {
			$transactionsDisplay .= '<div class="col-12 fw-semibold fs-5 text-yellow">'.$startDay->toStringShortThai().'</div>';
			$transactionsDisplay .= KYTransactionHistory::getHistoryBars($transactions);
		}
		$startDay->modifyDay(-1);
	}
	return $transactionsDisplay;
}

$request = KornRequest::get('timespan');
$requestText = null;
$transactionHeader = 'ภายในเจ็ดวันที่ผ่านมา';
$transactionsDisplay = getByDays(7);

if ($request->isValid()) {
	$requestText = $request->toString();
	$dateToday = new KornDateTime();

	if ($requestText == 'lastmonth') {
		$transactionHeader = 'ภายในเดือนที่แล้ว';
		$dateMonth = new KornDateTime();
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

	} else if ($requestText == 'thismonth') {
		$transactionHeader = 'ภายในเดือนนี้';
		$dateMonth = new KornDateTime();

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

	} else if ($requestText == 'fourteendays') {
		$transactionHeader = 'ภายในสิบสี่วันที่ผ่านมา';
		$transactionsDisplay = getByDays(14);
	}
}
if ($transactionsDisplay == '')
	$transactionsDisplay = KYTransactionHistory::historyEmpty();

?>

<section>
	<?= KYHeading::level1('ประวัติการเงิน', 'fa-clock-rotate-left',
		KYLink::internal('/finances', 'ย้อนกลับ', 'fa-rotate-left'),
	) ?>
	<div class="row g-2 mb-3">
		<div class="col-12">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5"><i class="fa-solid fa-wallet fa-fw me-2 text-yellow"></i>เงินคงเหลือ
				</div>
				<div class="fs-3">
					<span>฿</span>
					<span
						class="fw-semibold"><?= number_format(KYTransaction::reCalculateBalance(KYUser::loggedIn()), 2) ?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-5">
		<form method="get" autocomplete="off">
			<div class="d-flex gap-2 overflow-x-scroll">
				<button name="timespan" value="sevendays" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= is_null($requestText) || $requestText == 'sevendays' ? 'active' : '' ?>">
					ภายในเจ็ดวันที่ผ่านมา
				</button>
				<button name="timespan" value="fourteendays" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= $requestText == 'fourteendays' ? 'active' : '' ?>">
					ภายในสิบสี่วันที่ผ่านมา
				</button>
				<button name="timespan" value="thismonth" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= $requestText == 'thismonth' ? 'active' : '' ?>">
					ภายในเดือนนี้
				</button>
				<button name="timespan" value="lastmonth" type="submit"
				        class="btn btn-outline-yellow py-1 text-nowrap fw-bold <?= $requestText == 'lastmonth' ? 'active' : '' ?>">
					ภายในเดือนที่แล้ว
				</button>
			</div>
		</form>
	</div>
	<?= KYHeading::level2($transactionHeader) ?>
	<div class="row g-2">
		<?= $transactionsDisplay ?>
	</div>
</section>