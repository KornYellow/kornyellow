<?php

namespace contents\blogs;

use libraries\korn\client\KornHeader;
use libraries\korn\utils\KornDateTime;
use libraries\kornyellow\components\KYHeading;

KornHeader::constructHeader("บทความทั้งหมด");

$dateNow = new KornDateTime();
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
", 8);

?>

<section>
	<?= KYHeading::level1("บทความทั้งหมด") ?>
	<div class="row gy-3 gx-3">
		<?= $recentBlogs ?>
	</div>
</section>