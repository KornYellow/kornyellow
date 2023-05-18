<?php

namespace kornyellow\contents\finances;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Client\KornRequest;
use KornyellowLib\Utils\KornIcon;
use KornyellowLib\Utils\KornNetwork;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

KornHeader::constructHeader("คอนเฟิร์มลบข้อมูล?");

if (KornRequest::get("id")->isNull())
	KornNetwork::redirectPage("/finances");

$transaction = KYTransaction::get(KornRequest::get("id")->toInteger());
if (is_null($transaction))
	KornNetwork::redirectPage("/finances");

KYTransaction::remove($transaction);
KornNetwork::redirectPage("/finances", 1, false);

?>

<section>
	<?= KYCHeading::level1("กำลังลบข้อมูล ...", KornIcon::spinner()->more("fa-spin")) ?>
</section>
