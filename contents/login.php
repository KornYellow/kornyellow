<?php

namespace contents\login;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\korn\utils\KornIcon;
use libraries\korn\utils\KornNetwork;
use libraries\kornyellow\components\general\KYCForm;
use libraries\kornyellow\components\general\KYCHeading;
use libraries\kornyellow\instances\methods\KYUser;

KornHeader::constructHeader("เข้าสู่ระบบ");

if (KYUser::isLogin())
	KornNetwork::redirectPage("/profile");

if (KornRequest::post("submit")->isValid()) {
	$email = KornRequest::post("email")->toString();
	$password = KornRequest::post("password")->toString();

	$isLoginSuccess = KYUser::login($email, $password);
	if ($isLoginSuccess)
		KornNetwork::redirectPage("/profile");
}

?>

<section>
	<?= KYCHeading::level1("เข้าสู่ระบบ", KornIcon::rightToBracket()) ?>
	<form method="post">
		<div class="mb-3">
			<label for="email" class="form-label">ที่อยู่อีเมล</label>
			<input type="email" required class="form-control" name="email" id="email" placeholder="korn@kornyellow.com"
			       autocomplete="email" autofocus/>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">รหัสผ่าน</label>
			<input type="password" required class="form-control" name="password" id="password" placeholder="********"
			       autocomplete="current-password"/>
			<div class="form-text">เราจะไม่เผยแพร่ข้อมูลของคุณกับผู้อื่น</div>
		</div>
		<?= KYCForm::submitButton("เข้าสู่ระบบ", KornIcon::rightToBracket()) ?>
	</form>
</section>