<section class="page-section package-listing" id="home">
	<div class="container">
		<div class="section-heading-row">
			<div>
				<p class="section-kicker">All destinations</p>
				<h2 class="section-title">Tour Packages</h2>
			</div>
			<a href="./" class="btn btn-link-modern"><i class="fa fa-arrow-left"></i> Back home</a>
		</div>
		<div class="package-grid">
		<?php
		$packages = $conn->query("SELECT * FROM `packages` WHERE `status` = 1 order by id asc ");
			while($row = $packages->fetch_assoc() ):
				$cover = package_cover($row);
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
				$review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}'");
				$review_count = $review->num_rows;
				$rate = 0;
				while($r= $review->fetch_assoc()) $rate += $r['rate'];
				if($rate > 0 && $review_count > 0) $rate = number_format($rate/$review_count,0,"");
		?>
			<article class="tour-card tour-card-horizontal">
				<a class="tour-card-media" href="./?page=view_package&id=<?php echo md5($row['id']) ?>">
					<img src="<?php echo $cover ?>" alt="<?php echo htmlspecialchars($row['title']) ?>">
					<span class="tour-price"><i class="fa fa-tag"></i> <?php echo number_format($row['cost']) ?></span>
				</a>
				<div class="tour-card-body">
					<div class="tour-rating">
						<span class="stars-text"><?php echo render_stars($rate); ?></span>
						<span><?php echo $review_count ?> review<?php echo $review_count == 1 ? '' : 's' ?></span>
					</div>
					<h3><?php echo $row['title'] ?></h3>
					<p class="tour-location"><i class="fa fa-map-marker-alt"></i> <?php echo $row['tour_location'] ?></p>
					<p class="truncate"><?php echo $row['description'] ?></p>
					<a href="./?page=view_package&id=<?php echo md5($row['id']) ?>" class="btn btn-modern-primary">View Package <i class="fa fa-arrow-right"></i></a>
				</div>
			</article>
		<?php endwhile; ?>
		</div>
	</div>
</section>
