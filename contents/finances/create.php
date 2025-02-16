<?php

namespace kornyellow\contents\finances;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Client\KornRequest;
use KornyellowLib\Utils\KornDateTime;
use KornyellowLib\Utils\KornIcon;
use KornyellowLib\Utils\KornNetwork;
use libraries\kornyellow\components\general\KYCForm;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\components\general\KYCScript;
use libraries\kornyellow\components\KYCTransaction;
use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\classes\transaction\Transaction;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader("อัปเดตข้อมูลการเงิน");
KYCScript::enableTransaction();

if (KornRequest::post("submit")->isValid()) {
	$dateToday = KornDateTime::now();

	$amount = floatval(str_replace(",", "", KornRequest::post("amount")->toString()));
	$name = KornRequest::post("name")->toString();
	$type = EnumTransactionType::create(KornRequest::post("type")->toString());
	$category = KYTransactionCategory::get(KornRequest::post("category")->toInteger());

	$date = KornRequest::post("date")->toString();
	$hour = KornRequest::post("timeHour")->toInteger();
	$minute = KornRequest::post("timeMinute")->toInteger();
	$second = KornRequest::post("timeSecond")->toInteger();
	$time = "$hour:$minute:$second";

	$dateTime = new KornDateTime("{$dateToday->toMySQLDate()} $time");
	if ($date == "onedayago")
		$dateTime->modifyDay(-1);
	if ($date == "twodayago")
		$dateTime->modifyDay(-2);

	KYTransaction::add(new Transaction(
		null, KYUser::getLoggedIn(), $category, $name,
		$type, $amount, $dateTime,
	));

	KornNetwork::redirectPage("/finances");
}

?>

<section>
	<?= KYCHeading::level1("อัปเดตข้อมูลการเงิน", KornIcon::penToSquare(),
		KYCLink::internal("/finances", "ย้อนกลับ", KornIcon::rotateLeft()),
	) ?>
	<div class="row g-2 mb-5">
		<div class="col-12">
			<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-nowrap">
				<div class="text-slate-400 fs-5">
					<?= KornIcon::wallet()->me1()->more("text-yellow") ?>
					เงินคงเหลือ
				</div>
				<div class="fs-3">
					<span>฿</span>
					<span
						class="fw-semibold"><?= number_format(KYTransaction::reCalculateBalance(KYUser::getLoggedIn()), 2) ?></span>
				</div>
			</div>
		</div>
	</div>
	<?= KYCHeading::level2("เพิ่มรายการการเงินใหม่") ?>
	<form method="post" autocomplete="off">
		<div class="mb-3">
			<div class="row g-2">
				<div class="col">
					<input required type="radio" class="btn-check" name="type" value="outcome" id="typeOutcome"
					       autocomplete="off" checked>
					<label class="btn btn-outline-yellow d-block fs-4 fw-bold py-1" for="typeOutcome">
						<?= KornIcon::cashRegister()->me1() ?>
						รายจ่าย
					</label>
				</div>
				<div class="col">
					<input required type="radio" class="btn-check" name="type" value="income" id="typeIncome"
					       autocomplete="off">
					<label class="btn btn-outline-yellow d-block fs-4 fw-bold py-1" for="typeIncome">
						<?= KornIcon::wallet()->me1() ?>
						รายรับ
					</label>
				</div>
			</div>
		</div>
		<div class="row g-2 mb-3">
			<div class="col">
				<label for="amount" class="form-label">เป็นจำนวนเงิน</label>
				<div class="input-baht">
					<input type="text" required class="form-control" name="amount" id="amount" placeholder="0.00"
					       inputmode="numeric" autocomplete="off"/>
				</div>
			</div>
			<div class="col">
				<label for="name" class="form-label">ชื่อรายการ</label>
				<input type="text" required class="form-control" name="name" id="name"
				       placeholder="รายการการเงิน" autocomplete="off" list="transaction_name_result"/>
				<datalist id="transaction_name_result"></datalist>
			</div>
		</div>
		<div class="mb-3">
			<label for="category" class="form-label">ชนิดของการเงิน</label>
			<select required class="form-select" id="category" name="category">
				<?= KYCTransaction::getCategoryOptions() ?>
			</select>
		</div>
		<div class="mb-3">
			<div class="row row-cols-auto g-2">
				<div class="col">
					<input required type="radio" class="btn-check" name="date" value="today" id="dateToday"
					       autocomplete="off" checked>
					<label class="btn btn-outline-yellow py-1 text-nowrap fw-bold" for="dateToday">วันนี้</label>
				</div>
				<div class="col">
					<input required type="radio" class="btn-check" name="date" value="onedayago" id="dateYesterday"
					       autocomplete="off">
					<label class="btn btn-outline-yellow py-1 text-nowrap fw-bold" for="dateYesterday">เมื่อวาน</label>
				</div>
				<div class="col">
					<input required type="radio" class="btn-check" name="date" value="twodayago" id="dateTwoDayAgo"
					       autocomplete="off">
					<label class="btn btn-outline-yellow py-1 text-nowrap fw-bold"
					       for="dateTwoDayAgo">เมื่อวานซืน</label>
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="time" class="form-label">เวลาที่ทำรายการ</label>
			<div class="row g-2">
				<label class="col" for="timeHour">
					<input required type="number" max="23" min="0" id="timeHour"
					       name="timeHour" class="form-control"
					       value="<?= (KornDateTime::now())->getHour() ?>">
				</label>
				<label class="col" for="timeMinute">
					<input required type="number" max="59" min="0" id="timeMinute"
					       name="timeMinute" class="form-control"
					       value="<?= (KornDateTime::now())->getMinute() ?>">
				</label>
				<label class="col" for="timeSecond">
					<input required type="number" max="59" min="0" id="timeSecond"
					       name="timeSecond" class="form-control"
					       value="<?= (KornDateTime::now())->getSecond() ?>">
				</label>
			</div>
			<div class="form-text">เราจะไม่เผยแพร่ข้อมูลของคุณกับผู้อื่น</div>
		</div>
		<?= KYCForm::submitButton("อัปเดตข้อมูลการเงิน", KornIcon::penToSquare()) ?>
	</form>
</section>