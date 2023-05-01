<?php

namespace contents\about;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornDateTime;
use libraries\kornyellow\components\KYHeading;
use libraries\kornyellow\components\KYLink;

KornHeader::constructHeader('รู้จักผมกัน');

$birthDay = KornDateTime::createFromDateThai(26, 8, 2545);
$ageInYears = $birthDay->getDifferenceInYears(new KornDateTime());

?>

<section>
	<?= KYHeading::level1('ผมเป็นใคร', 'fa-question') ?>
	<div class="bg-slate-700 rounded-3 px-2 px-sm-4 py-4 mb-5">
		<div class="row g-4">
			<div class="col-12 col-lg-3">
				<div class="img-square rounded-3">
					<img class="img-fluid" src="/static/kornyellow/images/korn_portrait.jpg" alt="Korn Portrait">
				</div>
			</div>
			<div class="col-12 col-lg-9">
				<div class="fs-2 fw-semibold mb-2 text-slate-400"><i
						class="fa-solid fa-hand fa-fw me-3 text-yellow"></i>สวัสดีครับ
				</div>
				<p>ผม นายกร โรจน์รัตนปัญญา ตอนนี้อายุ <?= $ageInYears ?> ปี เป็นคนที่มุ่งมั่นมาก ๆ
					และตั้งใจทำทุกอย่างเพื่อครอบครัว ความฝันของผมคือต้องการเขียน Open source ให้ทุกคนได้ใช้ฟรี ๆ
					แต่ด้วยผมต้องกินข้าวและครอบครัวผมต้องกินข้าว ดังนั้นผมจึงต้องมาทำงานหาเงินก่อนนั่นเอง
					สิ่งที่ผมถนัดคือการเขียนเว็บไซต์ให้กับคุณ สิ่งที่คุณจะได้จากผมคือ ที่ปรึกษาด้านการออกแบบเว็บไซต์
					และคนที่จะสร้างเว็บไซต์ในฝันให้กับคุณ</p>
			</div>
		</div>
	</div>

	<?= KYHeading::level2('งานหลักที่รับ', 'fa-briefcase') ?>
	<ul class="mb-5">
		<li><span class="text-yellow fw-semibold">PHP Website</span> - จากดีไซน์สู่เว็บไซต์ที่ใช้งานได้จริง และรวดเร็ว
		</li>
		<li><span class="text-yellow fw-semibold">Wordpress Website</span> - ไม่ว่าจะเป็นออกแบบ วางระบบ แก้ปัญหา
			หรือทำตามดีไซน์
		</li>
		<li><span class="text-yellow fw-semibold">Frontend</span> - HTML, CSS, Javascript ที่ผมขัดเกลามาอย่างดี
			หรือจะเป็น React Framework ก็ไม่ติด
		</li>
		<li><span class="text-yellow fw-semibold">Website Design</span> - อยากให้ออกแบบเว็บไซต์สวย ๆ บน Figma
			ตามความฝันของคุณ? ไม่มีปัญหา
		</li>
	</ul>

	<?= KYHeading::level2('งานอื่น ๆ ที่รับ', 'fa-circle-info') ?>
	<ul class="mb-5">
		<li><span class="text-yellow fw-semibold">Speaker</span> - รับเป็นวิทยากรให้ความรู้ หรือแนะนำสิ่งต่าง ๆ เช่น
			การเขียนเว็บ เขียนเกม เขียนโปรแกรม หรืออื่น ๆ ที่คุณเสนอมา
		</li>
		<li><span class="text-yellow fw-semibold">Tutor</span> - รับสอนสิ่งต่าง ๆ เช่น การเขียนเว็บ เขียนเกม
			เขียนโปรแกรม หรืออื่น ๆ ที่คุณเสนอมา
		</li>
	</ul>

	<?= KYHeading::level2('ประสบการณ์ และการศึกษา', 'fa-graduation-cap') ?>
	<ul class="mb-5">
		<li><span class="text-yellow fw-semibold">University</span> -
			ขณะนี้กำลังศึกษาอยู่ในสถาบันพระจอมเกล้าคุณทหารลาดกระบัง คณะวิศวกรรม สาขาวิศวกรรมคอมพิวเตอร์
		</li>
		<li><span class="text-yellow fw-semibold">PHP Expert</span> - พัฒนาเว็บไซต์โดยเขียน PHP Framework
			ขึ้นมาเองให้กับโรงเรียนหนึ่ง โดยมีระบบครบถ้วนซึ่งใช้แค่ Pure PHP เท่านั้น และโปรเจกต์อื่น ๆ
		</li>
		<li><span class="text-yellow fw-semibold">Wordpress Expert</span> - เป็นผู้ออกแบบโครงและดูแลเว็บไซต์ Wordpress
			ให้กับสถานีตำรวจเกือบทั่วประเทศ และอื่น ๆ ที่เกี่ยวข้อง
		</li>
		<li><span class="text-yellow fw-semibold">Intermediate Speaker</span> -
			เคยเป็นวิทยากรให้กับโรงเรียนมาแล้วหลายแห่ง
		</li>
	</ul>

	<?= KYHeading::level2('ช่องทางการติดต่อ', 'fa-phone') ?>
	<ul>
		<li><?= KYLink::external('https://github.com/kornyellow', 'GitHub') ?> -
			พื้นที่เก็บโปรเจกต์เกือบทั้งหมดในชีวิตผม รวมถึง Open source ที่ผมกล่าวถึง
		</li>
		<li><?= KYLink::external('https://youtube.com/kornyellow', 'YouTube') ?> - พื้นที่เก็บโปรเจกต์ในรูปแบบวีดีโอ
			หรือจะเป็นอะไรก็ได้ที่ผมอยากทำ
		</li>
		<li><?= KYLink::external('https://facebook.com/kornyellow', 'Facebook') ?> - เผื่อคุณอยากรู้ชีวิตของผม</li>
		<li><?= KYLink::external('https://instagram.com/korn.yellow', 'Instagram') ?> - เผื่อคุณอยากรู้ชีวิตของผม</li>
		<li><span class="text-yellow fw-semibold">kornkubzaza@gmail.com</span> - เผื่อคุณอยากเริ่มงานกับผม</li>
		<li><span class="text-yellow fw-semibold">084-228-7850</span> - เผื่อคุณอยากเริ่มงานกับผม</li>
	</ul>
</section>
