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
use libraries\kornyellow\instances\methods\KYUser;
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
	$time = $hour.":".$minute.":".$second;
	$dateTime = new KornDateTime($date." ".$time);

	$transaction->setAmount($amount);
	$transaction->setName($name);
	$transaction->setTransactionType($type);
	$transaction->setTransactionCategory($category);
	$transaction->setNote($note);
	$transaction->setDateTime($dateTime);

	KYTransaction::add($transaction);

	KornNetwork::redirectPage("/finances");
}

$categories = "";
$transactionCategories = KYTransactionCategory::getByUser(KYUser::loggedIn());
if (!is_null($transactionCategories)) {
	foreach ($transactionCategories as $transactionCategory) {
		$note = is_null($transactionCategory->getNote()) ? "" : "({$transactionCategory->getNote()})";
		$categories .= "
			<option value='{$transactionCategory->getID()}' 
				".KYForm::isSelected($transaction->getTransactionCategory()?->getID() == $transactionCategory->getID()).">
				{$transactionCategory->getName()} $note
			</option>
		";
	}
}
$categories .= "
	<option value='-1'
		".KYForm::isSelected(is_null($transaction->getTransactionCategory())).">
		อื่น ๆ
	</option>
";

?>

<section>
	<?= KYHeading::level1("แก้ไขข้อมูลการเงิน", "fa-pen-to-square",
		KYLink::internal("/finances", "ย้อนกลับ", "fa-rotate-left"),
	) ?>
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
				       placeholder="รายการการเงิน" autocomplete="off" value="<?= $transaction->getName() ?>"/>
			</div>
			<div class="col">
				<label for="amount" class="form-label">เป็นจำนวนเงิน</label>
				<div class="input-baht">
					<input type="text" required class="form-control" name="amount" id="amount" placeholder="0.00"
					       autocomplete="off" value="<?= number_format($transaction->getAmount(), 2) ?>"/>
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
		<?= KYForm::submitButton("แก้ไขข้อมูลการเงิน", "fa-pen-to-square") ?>
	</form>
</section>
