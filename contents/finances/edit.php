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
use libraries\kornyellow\components\KYCTransaction;
use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader("แก้ไขชนิดการเงิน");

if (KornRequest::get("id")->isNull())
	KornNetwork::redirectPage("/finances");

$transaction = KYTransaction::get(KornRequest::get("id")->toInteger());

if (KornRequest::post("submit")->isValid()) {
	$amount = floatval(str_replace(",", "", KornRequest::post("amount")->toString()));
	$name = KornRequest::post("name")->toString();
	$type = EnumTransactionType::create(KornRequest::post("type")->toString());
	$category = KYTransactionCategory::get(KornRequest::post("category")->toInteger());
	$note = KornRequest::post("note")->toStringNullable();

	$date = KornRequest::post("date")->toString();
	$hour = KornRequest::post("timeHour")->toInteger();
	$minute = KornRequest::post("timeMinute")->toInteger();
	$second = KornRequest::post("timeSecond")->toInteger();
	$time = "$hour:$minute:$second";
	$dateTime = new KornDateTime("$date $time");

	$transaction->setAmount($amount);
	$transaction->setName($name);
	$transaction->setTransactionType($type);
	$transaction->setTransactionCategory($category);
	$transaction->setNote($note);
	$transaction->setDateTime($dateTime);

	KYTransaction::add($transaction);

	KornNetwork::redirectPage("/finances");
}

?>

<section>
	<?= KYCHeading::level1("แก้ไขข้อมูลการเงิน", KornIcon::penToSquare(),
		KYCLink::internal("/finances", "ย้อนกลับ", KornIcon::rotateLeft()),
	) ?>
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
					       autocomplete="off" value="<?= number_format($transaction->getAmount(), 2) ?>"/>
				</div>
			</div>
			<div class="col">
				<label for="name" class="form-label">ชื่อรายการ</label>
				<input type="text" required class="form-control" name="name" id="name"
				       placeholder="รายการการเงิน" autocomplete="off" value="<?= $transaction->getName() ?>"/>
			</div>
		</div>
		<div class="mb-3">
			<label for="category" class="form-label">ชนิดของการเงิน</label>
			<select required class="form-select" id="category" name="category">
				<?= KYCTransaction::getCategoryOptions($transaction) ?>
			</select>
		</div>
		<div class="mb-3">
			<label for="date" class="form-label">วันที่ทำรายการ</label>
			<input required type="date" id="date"
			       name="date" class="form-control"
			       value="<?= $transaction->getDateTime()->toMySQLDate() ?>">
		</div>
		<div class="mb-3">
			<label for="time" class="form-label">เวลาที่ทำรายการ</label>
			<div class="row g-2">
				<label class="col" for="timeHour">
					<input required type="number" max="23" min="0" id="timeHour"
					       name="timeHour" class="form-control"
					       value="<?= $transaction->getDateTime()->getHour() ?>">
				</label>
				<label class="col" for="timeMinute">
					<input required type="number" max="59" min="0" id="timeMinute"
					       name="timeMinute" class="form-control"
					       value="<?= $transaction->getDateTime()->getMinute() ?>">
				</label>
				<label class="col" for="timeSecond">
					<input required type="number" max="59" min="0" id="timeSecond"
					       name="timeSecond" class="form-control"
					       value="<?= $transaction->getDateTime()->getSecond() ?>">
				</label>
			</div>
		</div>
		<div class="mb-3">
			<label for="note" class="form-label">เตือนความจำ</label>
			<textarea class="form-control" name="note" id="note" placeholder="บันทึกเพิ่มเติม..."
			          autocomplete="off"><?= $transaction->getNote() ?></textarea>
			<div class="form-text">เราจะไม่เผยแพร่ข้อมูลของคุณกับผู้อื่น</div>
		</div>
		<?= KYCForm::submitButton("แก้ไขข้อมูลการเงิน", KornIcon::penToSquare()) ?>
	</form>
</section>
