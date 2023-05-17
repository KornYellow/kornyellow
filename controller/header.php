<?php

namespace kornyellow\templates;

use KornyellowLib\Client\KornHeader;
use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\instances\methods\KYUser;

?>

<!DOCTYPE html>
<html lang="th" data-bs-theme="dark">

<head>
	<meta charset="utf-8">
	<meta http-equiv="content-security-policy" content="
		default-src 'self' www.youtube.com;
		script-src 'self' 'unsafe-inline' cdn.jsdelivr.net kit.fontawesome.com 'sha256-jo/2B4g3Be+aX/ZBPjuNtTHv4Ydazkz5qAG2FMdKlo8=' 'sha256-tuaE6LEzkgJRBa3LtOtRMO9F+16ZAMFpJ4aBiOnVrAs=';
		style-src 'self' 'unsafe-inline' cdn.jsdelivr.net fonts.googleapis.com;
		connect-src 'self' ka-f.fontawesome.com;
		font-src 'self' ka-f.fontawesome.com fonts.gstatic.com;
		img-src 'self' i.ytimg.com data: image/svg+xml;
	">

	<title><?= KornHeader::getTitle() ?></title>

	<meta name="title" content="<?= KornHeader::getTitle() ?>">
	<meta name="author" content="<?= KornHeader::getAuthor() ?>">
	<meta name="owner" content="<?= KornHeader::getOwner() ?>">
	<meta name="keywords" content="<?= KornHeader::getKeywords() ?>">
	<meta name="description" content="<?= KornHeader::getDescription() ?>">
	<meta name="abstract" content="<?= KornHeader::getAbstract() ?>">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap 5.3.0 alpha 2 (Last-Update 28/03/2023) -->
	<script src="/static/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>

	<!-- Font Awesome 6 (Last-Update 05/02/2023) -->
	<link href="/static/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="/static/fontawesome/css/brands.css" rel="stylesheet">
	<link href="/static/fontawesome/css/solid.css" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="/static/kornyellow/scss/custom.css">

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/static/kornyellow/favicons/apple.png">
	<link rel="icon" sizes="any" href="/static/kornyellow/favicons/favicon.ico">
	<link rel="shortcut icon" href="/static/kornyellow/favicons/favicon.ico">
	<link rel="manifest" href="/static/kornyellow/favicons/site.webmanifest">

	<!-- Javascript -->
	<script src="/static/kornyellow/js/script.js" type="text/javascript" defer></script>

	<!-- Canonical -->
	<link rel="canonical" href="https://kornyellow.com/<?= KornHeader::getCanonical() ?>">
</head>

<body class="vh-100 d-flex flex-column bg-slate-900">

<nav class="flex-shrink-0 navbar navbar-expand-lg my-1">
	<div class="container">
		<h1 class="mb-0">
			<a class="navbar-brand fs-3 me-2 h-100 pe-2 d-flex align-items-center" title="KORNYELLOW Logo" href="/">
				<img width="50" src="/static/kornyellow/images/kornyellow_watermark.png" alt="KORNYELLOW Logo">
				<span class="pt-1">
					<span>KORN</span><span class="text-yellow">YELLOW</span>
				</span>
			</a>
		</h1>
		<button class="navbar-toggler fs-1 border-0" title="Toggle Menu" type="button" data-bs-toggle="collapse"
		        data-bs-target="#navbar">
			<?= KornIcon::bars() ?>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav fw-semibold ms-auto">
				<li class="nav-item">
					<a class="nav-link px-3" href="/blogs" title="บทความ">บทความ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-3" href="/about/me" title="รู้จักผมกัน">รู้จักผมกัน</a>
				</li>
				<?php if (!KYUser::isLogin()): ?>
					<li class="nav-item">
						<a class="nav-link px-3" href="/login" title="เข้าสู่ระบบ">เข้าสู่ระบบ</a>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link px-3" href="/finances" title="จัดการรายจ่าย">จัดการรายจ่าย</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-slate-100 px-3" href="#" role="button"
						   data-bs-toggle="dropdown" title="บัญชี">
							<?= KornIcon::user() ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="/profile">
									<?= KornIcon::cog()->me2() ?>
									<span class="fw-semibold">จัดการบัญชีผู้ใช้</span>
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="/logout">
									<?= KornIcon::rightFromBracket()->me2()->more("text-yellow") ?>
									<span class="fw-semibold text-yellow">ออกจากระบบ</span>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>

<main class="container px-2 py-3 p-sm-4 flex-fill bg-slate-800 rounded rounded-3 border-slate-600">
