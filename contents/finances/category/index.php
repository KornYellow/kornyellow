<?php

namespace contents\finances\category;

use libraries\korn\client\KornHeader;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader("จัดการชนิดการเงิน");

$transactionCategories = KYTransactionCategory::getByUser(KYUser::loggedIn());

$tableContent = "";
if (is_null($transactionCategories)) {
	$tableContent = "
		<tr>
			<td class='text-center' colspan='4'>ไม่พบรายการ กรุณาเพิ่มชนิดการเงิน</td>
		</tr>
	";
} else {
	foreach ($transactionCategories as $transactionCategory) {
		$editButton = KYLink::internal("/finances/category/edit?id=$transactionCategory->getID()", "แก้ไข");
		$tableContent .= "
			<tr>
				<td>{$transactionCategory->getName()}</td>
				<td>{$transactionCategory->getNote()}</td>
				<td>$editButton</td>
			</tr>
    ";
	}
}

?>

<section>
	<?= KYHeading::level1("จัดการชนิดการเงิน", "fa-list",
		KYLink::internal("/finances/category/create", "เพิ่มชนิดการเงิน", "fa-plus"),
		KYLink::internal("/finances", "ย้อนกลับ", "fa-rotate-left"),
	) ?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">รายการ</th>
			<th scope="col">รายละเอียด</th>
			<th scope="col">จัดการ</th>
		</tr>
		</thead>
		<tbody>
		<?= $tableContent ?>
		</tbody>
	</table>
</section>
