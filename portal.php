<?php
$featured_packages = $conn->query("SELECT * FROM `packages` WHERE `status` = 1 ORDER BY id ASC LIMIT 3");
?>
<style>
	header.masthead{
		background-image: linear-gradient(90deg, rgba(12, 28, 34, .86), rgba(12, 28, 34, .42)), url('<?php echo validate_image($_settings->info('cover')) ?>') !important;
	}
</style>
<header class="masthead tourism-hero">
	<div class="container">
		<div class="hero-copy">
			<p class="hero-kicker">Curated tours, simple booking</p>
			<h1 class="masthead-heading">Explore Tour Packages</h1>
			<p class="hero-text">Find destinations, compare prices, read traveler feedback, and reserve your next trip in a few clicks.</p>
			<div class="hero-actions">
				<a class="btn btn-primary btn-xl" href="#home"><i class="fas fa-compass"></i> Browse Tours</a>
				<a class="btn btn-outline-light btn-xl" href="#contact"><i class="fas fa-envelope"></i> Ask a Question</a>
			</div>
		</div>
	</div>
</header>

<section class="page-section section-soft" id="home">
	<div class="container">
		<div class="section-heading-row">
			<div>
				<p class="section-kicker">Featured packages</p>
				<h2 class="section-title">Popular Tours</h2>
			</div>
			<a href="./?page=packages" class="btn btn-link-modern">Explore all <i class="fa fa-arrow-right"></i></a>
		</div>
		<div class="row g-4">
			<?php while($row = $featured_packages->fetch_assoc() ):
				$cover = package_cover($row);
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
				$review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}'");
				$review_count = $review->num_rows;
				$rate = 0;
				while($r= $review->fetch_assoc()) $rate += $r['rate'];
				if($rate > 0 && $review_count > 0) $rate = number_format($rate/$review_count,0,"");
			?>
			<div class="col-md-4">
				<article class="tour-card">
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
						<a href="./?page=view_package&id=<?php echo md5($row['id']) ?>" class="btn btn-modern-primary w-100">View Package</a>
					</div>
				</article>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>

<section class="page-section" id="about">
	<div class="container">
		<div class="content-band">
			<div>
				<p class="section-kicker">About us</p>
				<h2 class="section-title">Travel Planning Without the Fuss</h2>
			</div>
			<div class="content-copy">
				<?php echo file_get_contents(base_app.'about.html') ?>
			</div>
		</div>
	</div>
</section>

<section class="page-section contact-section" id="contact">
	<div class="container">
		<div class="section-heading-row text-light">
			<div>
				<p class="section-kicker">Contact</p>
				<h2 class="section-title">Send an Inquiry</h2>
			</div>
			<p class="contact-note">Have a destination, schedule, or package question? Send the team a message.</p>
		</div>
		<form id="contactForm" class="modern-form">
			<div class="row g-3">
				<div class="col-md-6">
					<input class="form-control" id="name" name="name" type="text" placeholder="Your name" required />
				</div>
				<div class="col-md-6">
					<input class="form-control" id="email" name="email" type="email" placeholder="Your email" required />
				</div>
				<div class="col-12">
					<input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required />
				</div>
				<div class="col-12">
					<textarea class="form-control" id="message" name="message" placeholder="Message" required></textarea>
				</div>
			</div>
			<div class="text-end mt-4">
				<button class="btn btn-primary btn-xl" id="submitButton" type="submit"><i class="fa fa-paper-plane"></i> Send Message</button>
			</div>
		</form>
	</div>
</section>
<script>
$(function(){
	$('#contactForm').submit(function(e){
		e.preventDefault()
		start_loader()
		$.ajax({
			url:_base_url_+"classes/Master.php?f=save_inquiry",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occurred",'error')
				end_loader()
			},
			success:function(resp){
				if(typeof resp == 'object' && resp.status == 'success'){
					alert_toast("Inquiry sent",'success')
					$('#contactForm').get(0).reset()
				}else{
					console.log(resp)
					alert_toast("An error occurred",'error')
				}
				end_loader()
			}
		})
	})
})
</script>
