<?php

namespace contents\finances;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornDateTime;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\components\KYTransactionHistory;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader('จัดการการเงิน');

$dateToday = new KornDateTime();
$dateThisMonth = new KornDateTime();
$dateThisYear = new KornDateTime();

$currentBalance = KYTransaction::reCalculateBalance(KYUser::loggedIn());

$incomeInMonth = KYTransaction::getIncomeByMonth($dateThisMonth, KYUser::loggedIn());
$incomeInMonthAverage = $incomeInMonth / $dateThisMonth->getDate();

$outcomeInMonth = KYTransaction::getOutcomeByMonth($dateThisMonth, KYUser::loggedIn());
$outcomeInMonthAverage = $outcomeInMonth / $dateThisMonth->getDate();

$transactions = KYTransaction::getByDay($dateToday, KYUser::loggedIn());
$transactionsDisplay = KYTransactionHistory::getHistoryBars($transactions);

if ($transactionsDisplay == '')
	$transactionsDisplay = KYTransactionHistory::historyEmpty();

?>

<section>
	<?= KYHeading::level1('จัดการการเงิน', 'fa-list',
		KYLink::internal('/finances/create', 'อัปเดตข้อมูลการเงิน', 'fa-pen-to-square'),
		KYLink::internal('/finances/category', 'จัดการชนิดการเงิน', 'fa-tag'),
	) ?>
	<div class="row g-2 mb-5">
		<div class="col-12 col-lg-4">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5"><i class="fa-solid fa-wallet fa-fw me-2 text-yellow"></i>เงินคงเหลือ
				</div>
				<div class="fs-3">
					<span>฿</span>
					<span class="fw-semibold"><?= number_format($currentBalance, 2) ?></span>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5"><i class="fa-solid fa-turn-down fa-fw me-2 text-yellow"></i>รายรับรวมเดือนนี้
				</div>
				<div class="d-flex justify-content-between">
					<div class="fs-3">
						<span>฿</span>
						<span class="fw-semibold"><?= number_format($incomeInMonth, 2) ?></span>
					</div>
					<div class="text-slate-400 text-truncate">
						<small>เฉลี่ย <?= number_format($incomeInMonthAverage, 2) ?> ต่อวัน</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5"><i class="fa-solid fa-turn-up fa-fw me-2 text-yellow"></i>รายจ่ายรวมเดือนนี้
				</div>
				<div class="d-flex justify-content-between">
					<div class="fs-3">
						<span>฿</span>
						<span class="fw-semibold"><?= number_format($outcomeInMonth, 2) ?></span>
					</div>
					<div class="text-slate-400 text-truncate">
						<small>เฉลี่ย <?= number_format($outcomeInMonthAverage, 2) ?> ต่อวัน</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= KYHeading::level1('ประวัติการเงินวันนี้', 'fa-clock-rotate-left',
		KYLink::internal('/finances/statistic', 'ดูสถิติ', 'fa-chart-column'),
		KYLink::internal('/finances/history', 'ดูเพิ่มเติม', 'fa-bars'),
	) ?>
	<div class="row g-2">
		<?= $transactionsDisplay ?>
	</div>
</section>