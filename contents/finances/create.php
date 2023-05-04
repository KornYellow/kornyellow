<?php

namespace contents\finances;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\korn\utils\KornDateTime;
use libraries\korn\utils\KornNetwork;
use libraries\kornyellow\components\KYForm;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\classes\transaction\Transaction;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader('อัปเดตข้อมูลการเงิน');

if (KornRequest::post('submit')->isValid()) {
	$dateToday = new KornDateTime();

	$amount = floatval(str_replace(',', '', KornRequest::post('amount')->toString()));
	$name = KornRequest::post('name')->toString();
	$type = EnumTransactionType::create(KornRequest::post('type')->toString());
	$category = KYTransactionCategory::get(KornRequest::post('category')->toInteger());
	$note = KornRequest::post('note')->toStringNullable();

	$date = KornRequest::post('date')->toString();

	$hour = KornRequest::post('timeHour')->toInteger();
	$minute = KornRequest::post('timeMinute')->toInteger();
	$second = KornRequest::post('timeSecond')->toInteger();
	$time = $hour.':'.$minute.':'.$second;

	$dateTime = new KornDateTime($dateToday->toMySQLDate().' '.$time);
	if ($date == 'onedayago')
		$dateTime->modifyDay(-1);
	if ($date == 'twodayago')
		$dateTime->modifyDay(-2);

	$user = KYUser::loggedIn();

	$newTransaction = new Transaction(
		null, $user, $category, $name,
		$note, $type, $amount, $dateTime,
	);

	$insertedID = KYTransaction::add($newTransaction);
	$newTransaction->setID($insertedID);

	KYTransaction::reCalculateBalance($user);

	KornNetwork::redirectPage('/finances');
}

$categories = '<option value="" disabled selected hidden>กดเพื่อเลือกชนิด</option>';
$transactionCategories = KYTransactionCategory::getByUser(KYUser::loggedIn());
if (!is_null($transactionCategories)) {
	foreach ($transactionCategories as $transactionCategory) {
		$categorie_note = is_null($transactionCategory->getNote()) ? '' : ' ('.$transactionCategory->getNote().')';
		$categories .= '<option value="'.$transactionCategory->getID().'">'.$transactionCategory->getName().$categorie_note.'</option>';
	}
}
$categories .= '<option value="-1">อื่น ๆ</option>';

?>

<section>
	<?= KYHeading::level1('อัปเดตข้อมูลการเงิน', 'fa-pen-to-square',
		KYLink::internal('/finances', 'ย้อนกลับ', 'fa-rotate-left'),
	) ?>
	<div class="row g-2 mb-5">
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
	<?= KYHeading::level2('เพิ่มรายการการเงินใหม่') ?>
	<form method="post" autocomplete="off">
		<div class="mb-3">
			<div class="row g-2">
				<div class="col">
					<input required type="radio" class="btn-check" name="type" value="outcome" id="typeOutcome"
					       autocomplete="off" checked>
					<label class="btn btn-outline-yellow d-block fs-4 fw-bold py-1" for="typeOutcome">
						<i class="fa-solid fa-cash-register fa-fw me-2"></i>รายจ่าย
					</label>
				</div>
				<div class="col">
					<input required type="radio" class="btn-check" name="type" value="income" id="typeIncome"
					       autocomplete="off">
					<label class="btn btn-outline-yellow d-block fs-4 fw-bold py-1" for="typeIncome">
						<i class="fa-solid fa-wallet fa-fw me-2"></i>รายรับ
					</label>
				</div>
			</div>
		</div>
		<div class="row g-2 mb-3">
			<div class="col">
				<label for="name" class="form-label">ชื่อรายการ</label>
				<input type="text" required class="form-control" name="name" id="name"
				       placeholder="รายการการเงิน" autocomplete="off"/>
			</div>
			<div class="col">
				<label for="amount" class="form-label">เป็นจำนวนเงิน</label>
				<div class="input-baht">
					<input type="text" required class="form-control" name="amount" id="amount" placeholder="0.00"
					       autocomplete="off"/>
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="category" class="form-label">ชนิดของการเงิน</label>
			<select required class="form-select" id="category" name="category">
				<?= $categories ?>
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
					<label class="btn btn-outline-yellow py-1 text-nowrap fw-bold" for="dateTwoDayAgo">เมื่อวานซืน</label>
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="time" class="form-label">เวลาที่ทำรายการ</label>
			<div class="row g-2">
				<label class="col" for="timeHour">
					<input required type="number" max="23" min="0" id="timeHour"
					       name="timeHour" class="form-control"
					       value="<?= (new KornDateTime())->getHour() ?>">
				</label>
				<label class="col" for="timeMinute">
					<input required type="number" max="59" min="0" id="timeMinute"
					       name="timeMinute" class="form-control"
					       value="<?= (new KornDateTime())->getMinute() ?>">
				</label>
				<label class="col" for="timeSecond">
					<input required type="number" max="59" min="0" id="timeSecond"
					       name="timeSecond" class="form-control"
					       value="<?= (new KornDateTime())->getSecond() ?>">
				</label>
			</div>
		</div>
		<div class="mb-3">
			<label for="note" class="form-label">เตือนความจำ</label>
			<textarea class="form-control" name="note" id="note" placeholder="บันทึกเพิ่มเติม..."
			          autocomplete="off"></textarea>
			<div class="form-text">เราจะไม่เผยแพร่ข้อมูลของคุณกับผู้อื่น</div>
		</div>
		<?= KYForm::submitButton('อัปเดตข้อมูลการเงิน', 'fa-pen-to-square') ?>
	</form>
</section>
