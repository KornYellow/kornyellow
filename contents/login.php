<?php

namespace contents\login;

use libraries\korn\client\KornHeader;
use libraries\korn\client\KornRequest;
use libraries\korn\utils\KornNetwork;
use libraries\kornyellow\components\KYForm;
use libraries\kornyellow\components\KYHeading;
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
	<?= KYHeading::level1("เข้าสู่ระบบ", "fa-right-to-bracket") ?>
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
		<?= KYForm::submitButton("เข้าสู่ระบบ", "fa-right-to-bracket") ?>
	</form>
</section>