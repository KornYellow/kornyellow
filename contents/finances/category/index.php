<?php

namespace kornyellow\contents\finances\category;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\components\general\KYCLink;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

KornHeader::constructHeader("จัดการชนิดการเงิน");

$transactionCategories = KYTransactionCategory::getByUser(KYUser::getLoggedIn());

$tableContent = "";
if (is_null($transactionCategories)) {
	$tableContent = "
		<tr>
			<td class='text-center' colspan='4'>ไม่พบรายการ กรุณาเพิ่มชนิดการเงิน</td>
		</tr>
	";
} else {
	foreach ($transactionCategories as $transactionCategory) {
		$editButton = KYCLink::internal("/finances/category/edit?id=$transactionCategory->getID()", "แก้ไข");
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
	<?= KYCHeading::level1("จัดการชนิดการเงิน", KornIcon::list(),
		KYCLink::internal("/finances/category/create", "เพิ่มชนิดการเงิน", KornIcon::plus()),
		KYCLink::internal("/finances", "ย้อนกลับ", KornIcon::rotateLeft()),
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
