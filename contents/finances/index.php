<?php

namespace kornyellow\contents\finances;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Utils\KornDateTime;
use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\components\KYCTransaction;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader("จัดการการเงิน");

$dateToday = KornDateTime::now();
$dateThisMonth = KornDateTime::now();
$dateThisYear = KornDateTime::now();

$currentBalance = KYTransaction::reCalculateBalance(KYUser::getLoggedIn());

$incomeInMonth = KYTransaction::getIncomeByMonth($dateThisMonth, KYUser::getLoggedIn());
$incomeInMonthAverage = $incomeInMonth / $dateThisMonth->getDate();

$outcomeInMonth = KYTransaction::getOutcomeByMonth($dateThisMonth, KYUser::getLoggedIn());
$outcomeInMonthAverage = $outcomeInMonth / $dateThisMonth->getDate();

$transactions = KYTransaction::getByDay($dateToday, KYUser::getLoggedIn());
$transactionsDisplay = KYCTransaction::getHistoryBars($transactions);

?>

<section>
	<?= KYCHeading::level1("จัดการการเงิน", KornIcon::list(),
		KYCLink::internal("/finances/create", "อัปเดตข้อมูลการเงิน", KornIcon::penToSquare()),
		KYCLink::internal("/finances/category", "จัดการชนิดการเงิน", KornIcon::tag()),
	) ?>
	<div class="row g-2 mb-5">
		<div class="col-12 col-lg-4">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5">
					<?= KornIcon::wallet()->me1()->more("text-yellow") ?>
					เงินคงเหลือ
				</div>
				<div class="fs-3">
					<span>฿</span>
					<span class="fw-semibold"><?= number_format($currentBalance, 2) ?></span>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5">
					<?= KornIcon::TurnDown()->me1()->more("text-yellow") ?>
					รายรับรวมเดือนนี้
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
				<div class="text-slate-400 fs-5">
					<?= KornIcon::TurnUp()->me1()->more("text-yellow") ?>
					รายจ่ายรวมเดือนนี้
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
	<?= KYCHeading::level1("ประวัติการเงินวันนี้", KornIcon::clockRotateLeft(),
		KYCLink::internal("/finances/statistic", "ดูสถิติ", KornIcon::chartColumn()),
		KYCLink::internal("/finances/history", "ดูเพิ่มเติม", KornIcon::bars()),
	) ?>
	<div class="row g-2">
		<?= $transactionsDisplay ?>
	</div>
</section>