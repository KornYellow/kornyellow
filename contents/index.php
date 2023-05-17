<?php

namespace contents;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornDateTime;
use libraries\kornyellow\components\general\KYCHeading;

KornHeader::constructHeader();

$dateNow = KornDateTime::now();
$recentBlogs = str_repeat("
	<article class='col-12 col-lg-6'>
		<div class='border border-1'>
			<a class='blog-link' href='#'>
				<div class='row gx-0'>
					<div class='col-4'>
						<img class='w-100 h-100 object-fit-cover' alt='placeholder' src='/static/kornyellow/images/placeholder.jpg'/>
					</div>
					<div class='col-8'>
						<div class='p-3'>
							<h3>บทความ</h3>
							<small class='text-muted'>{$dateNow->toStringShortThaiFormal()}</small>
						</div>
					</div>
				</div>
			</a>
		</div>
	</article>
", 4);

?>

<section>
	<?= KYCHeading::level1("บทความล่าสุด") ?>
	<div class="row gy-3 gx-3 mb-5">
		<?= $recentBlogs ?>
	</div>
</section>