<?php 
$files = array();
$feed = array();
$review_count = 0;
$rate = 0;
if(isset($_GET['id'])){
    $packages = $conn->query("SELECT * FROM `packages` where md5(id) = '{$_GET['id']}'");
    if($packages->num_rows > 0){
        foreach($packages->fetch_assoc() as $k => $v){
            $$k = $v;
        }
        $review = $conn->query("SELECT r.*,concat(firstname,' ',lastname) as name FROM `rate_review` r inner join users u on r.user_id = u.id where r.package_id='{$id}' order by unix_timestamp(r.date_created) desc ");
        $review_count = $review->num_rows;
        while($row= $review->fetch_assoc()){
            $rate += $row['rate'];
            if(!empty($row['review'])){
                $row['review'] = stripslashes(html_entity_decode($row['review']));
                $feed[] = $row;
            }
        }
        if($rate > 0 && $review_count > 0) $rate = number_format($rate/$review_count,0,"");
        $files = package_gallery(get_defined_vars());
    }
}
?>
<section class="page-section package-detail-page">
    <div class="container">
        <?php if(isset($id)): ?>
        <div class="detail-hero">
            <div class="detail-media">
                <div id="tourCarousel" class="carousel slide detail-gallery" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner h-100">
                        <?php foreach($files as $k => $img): ?>
                        <div class="carousel-item h-100 <?php echo $k == 0? 'active': '' ?>">
                            <img class="d-block w-100 h-100" src="<?php echo $img ?>" alt="<?php echo htmlspecialchars($title) ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if(count($files) > 1): ?>
                    <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only visually-hidden">Next</span>
                    </a>
                    <?php endif; ?>
                </div>
                <?php if(count($files) > 1): ?>
                <div class="gallery-thumbs">
                    <?php foreach($files as $k => $img): ?>
                    <button type="button" class="<?php echo $k == 0 ? 'active' : '' ?>" data-target="#tourCarousel" data-slide-to="<?php echo $k ?>" aria-label="View image <?php echo $k + 1 ?>">
                        <img src="<?php echo $img ?>" alt="">
                    </button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <aside class="booking-panel">
                <p class="section-kicker">Tour package</p>
                <h1><?php echo $title ?></h1>
                <p class="tour-location"><i class="fa fa-map-marker-alt"></i> <?php echo $tour_location ?></p>
                <div class="detail-meta">
                    <span class="stars-text"><?php echo render_stars($rate); ?></span>
                    <span><?php echo $review_count ?> rating<?php echo $review_count == 1 ? '' : 's' ?></span>
                </div>
                <div class="detail-price">
                    <span>Price</span>
                    <strong><?php echo number_format($cost) ?></strong>
                </div>
                <button class="btn btn-primary btn-xl w-100" type="button" id="book"><i class="fa fa-calendar-check"></i> Book Now</button>
            </aside>
        </div>

        <div class="detail-content">
            <article class="detail-main">
                <p class="section-kicker">Details</p>
                <h2>What to Expect</h2>
                <div class="package-description"><?php echo stripslashes(html_entity_decode($description)) ?></div>
            </article>
            <aside class="review-panel">
                <div class="review-header">
                    <div>
                        <p class="section-kicker">Traveler feedback</p>
                        <h2>Reviews</h2>
                    </div>
                    <span class="review-count"><?php echo count($feed) ?></span>
                </div>
                <?php if(count($feed) > 0): ?>
                    <?php foreach($feed as $r): ?>
                    <div class="review-card">
                        <div class="review-card-head">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo validate_image('assets/img/user.jpg') ?>" class="review-user-avatar" alt="">
                                <div>
                                    <strong><?php echo $r['name'] ?></strong>
                                    <small><?php echo date("M d, Y",strtotime($r['date_created'])) ?></small>
                                </div>
                            </div>
                            <span class="stars-text"><?php echo render_stars($r['rate']); ?></span>
                        </div>
                        <div class="review-feedback"><?php echo $r['review'] ?></div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty-note">No written reviews yet.</p>
                <?php endif; ?>
            </aside>
        </div>
        <?php else: ?>
            <div class="empty-state">
                <h1>Package not found</h1>
                <p>This package may have been removed or is no longer available.</p>
                <a class="btn btn-primary" href="./?page=packages">Browse Packages</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<script>
    $(function(){
        $('#book').click(function(){
            if("<?php echo $_settings->userdata('id') ?>" > 0)
                uni_modal("Book Info","book_form.php?package_id=<?php echo isset($id) ? $id : 0 ?>");
            else
                uni_modal("","login.php","large");
        })
    })
</script>
