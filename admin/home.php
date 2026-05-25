<?php
$package_count = $conn->query("SELECT COUNT(*) as total FROM packages")->fetch_assoc()['total'];
$booking_count = $conn->query("SELECT COUNT(*) as total FROM book_list")->fetch_assoc()['total'];
$pending_count = $conn->query("SELECT COUNT(*) as total FROM book_list WHERE status = 0")->fetch_assoc()['total'];
$inquiry_count = $conn->query("SELECT COUNT(*) as total FROM inquiry")->fetch_assoc()['total'];
$latest_bookings = $conn->query("SELECT b.*, p.title, concat(u.firstname,' ',u.lastname) as name FROM book_list b INNER JOIN packages p ON p.id = b.package_id INNER JOIN users u ON u.id = b.user_id ORDER BY b.date_created DESC LIMIT 5");
$top_packages = $conn->query("SELECT p.*, COUNT(b.id) as total_bookings FROM packages p LEFT JOIN book_list b ON b.package_id = p.id GROUP BY p.id ORDER BY total_bookings DESC, p.id ASC LIMIT 4");
?>
<style>
  .dashboard-hero {
    overflow: hidden;
    position: relative;
    padding: 2rem;
    color: #fff;
    background: linear-gradient(135deg, #0f766e, #2563eb 55%, #e76f51);
    border-radius: 8px;
    box-shadow: 0 18px 38px rgba(15, 35, 45, .2);
  }
  .dashboard-hero h2 {
    margin: 0;
    font-size: 2rem;
    font-weight: 800;
  }
  .dashboard-hero p {
    max-width: 720px;
    margin: .75rem 0 0;
    color: rgba(255,255,255,.86);
  }
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 1rem;
    margin: 1.25rem 0;
  }
  .stat-card,
  .admin-card {
    background: #fff;
    border: 1px solid rgba(15, 35, 45, .08);
    border-radius: 8px;
    box-shadow: 0 14px 32px rgba(15, 35, 45, .08);
  }
  .stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.15rem;
  }
  .stat-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
    color: #fff;
    background: #0f766e;
    border-radius: 8px;
    font-size: 1.25rem;
  }
  .stat-card:nth-child(2) .stat-icon { background: #2563eb; }
  .stat-card:nth-child(3) .stat-icon { background: #f59e0b; }
  .stat-card:nth-child(4) .stat-icon { background: #e76f51; }
  .stat-card small {
    display: block;
    color: #64748b;
    font-weight: 700;
  }
  .stat-card strong {
    display: block;
    color: #0f172a;
    font-size: 1.7rem;
    line-height: 1;
  }
  .dashboard-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 360px;
    gap: 1.25rem;
  }
  .admin-card {
    padding: 1.25rem;
  }
  .admin-card h3 {
    margin: 0 0 1rem;
    color: #0f172a;
    font-size: 1.15rem;
    font-weight: 800;
  }
  .quick-actions {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: .85rem;
    margin: 1.25rem 0;
  }
  .quick-action {
    display: flex;
    flex-direction: column;
    gap: .65rem;
    min-height: 112px;
    padding: 1rem;
    color: #0f172a;
    background: #fff;
    border: 1px solid rgba(15, 35, 45, .08);
    border-radius: 8px;
    box-shadow: 0 14px 32px rgba(15, 35, 45, .08);
    text-decoration: none;
  }
  .quick-action:hover {
    color: #0f766e;
    text-decoration: none;
    transform: translateY(-2px);
  }
  .quick-action i {
    color: #0f766e;
    font-size: 1.35rem;
  }
  .quick-action span {
    font-weight: 800;
  }
  .booking-row {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    padding: .85rem 0;
    border-top: 1px solid #e5e7eb;
  }
  .booking-row:first-of-type {
    border-top: 0;
  }
  .booking-row strong {
    color: #0f172a;
  }
  .booking-row small,
  .package-mini small {
    display: block;
    color: #64748b;
  }
  .status-pill {
    align-self: start;
    padding: .25rem .55rem;
    color: #92400e;
    background: #fef3c7;
    border-radius: 999px;
    font-size: .75rem;
    font-weight: 800;
    white-space: nowrap;
  }
  .status-pill.confirmed {
    color: #065f46;
    background: #d1fae5;
  }
  .status-pill.cancelled {
    color: #991b1b;
    background: #fee2e2;
  }
  .package-mini {
    display: grid;
    grid-template-columns: 74px 1fr;
    gap: .8rem;
    padding: .85rem 0;
    border-top: 1px solid #e5e7eb;
  }
  .package-mini:first-of-type {
    border-top: 0;
  }
  .package-mini img {
    width: 74px;
    height: 62px;
    object-fit: cover;
    border-radius: 8px;
  }
  @media (max-width: 991px) {
    .stat-grid,
    .dashboard-layout,
    .quick-actions {
      grid-template-columns: 1fr;
    }
  }
</style>
<div class="dashboard-hero">
  <h2>Welcome to <?php echo $_settings->info('name') ?></h2>
  <p>Manage tour packages, booking requests, inquiries, and traveler reviews from one clean dashboard.</p>
</div>
<div class="stat-grid">
  <div class="stat-card">
    <span class="stat-icon"><i class="fas fa-map-marked-alt"></i></span>
    <div><small>Packages</small><strong><?php echo number_format($package_count) ?></strong></div>
  </div>
  <div class="stat-card">
    <span class="stat-icon"><i class="fas fa-calendar-check"></i></span>
    <div><small>Total Bookings</small><strong><?php echo number_format($booking_count) ?></strong></div>
  </div>
  <div class="stat-card">
    <span class="stat-icon"><i class="fas fa-hourglass-half"></i></span>
    <div><small>Pending</small><strong><?php echo number_format($pending_count) ?></strong></div>
  </div>
  <div class="stat-card">
    <span class="stat-icon"><i class="fas fa-envelope-open-text"></i></span>
    <div><small>Inquiries</small><strong><?php echo number_format($inquiry_count) ?></strong></div>
  </div>
</div>
<div class="quick-actions">
  <a class="quick-action" href="<?php echo base_url ?>admin/?page=packages"><i class="fas fa-map-marked"></i><span>Packages</span></a>
  <a class="quick-action" href="<?php echo base_url ?>admin/?page=books"><i class="fas fa-th-list"></i><span>Bookings</span></a>
  <a class="quick-action" href="<?php echo base_url ?>admin/?page=inquiries"><i class="fas fa-question-circle"></i><span>Inquiries</span></a>
  <a class="quick-action" href="<?php echo base_url ?>admin/?page=review"><i class="fas fa-comment-alt"></i><span>Reviews</span></a>
  <a class="quick-action" href="<?php echo base_url ?>admin/?page=user"><i class="fas fa-users-cog"></i><span>Users</span></a>
  <a class="quick-action" href="<?php echo base_url ?>admin/?page=system_info"><i class="fas fa-cogs"></i><span>Settings</span></a>
</div>
<div class="dashboard-layout">
  <section class="admin-card">
    <h3>Latest Booking Requests</h3>
    <?php if($latest_bookings->num_rows > 0): ?>
      <?php while($row = $latest_bookings->fetch_assoc()):
        $status_class = $row['status'] == 1 ? 'confirmed' : ($row['status'] == 2 ? 'cancelled' : '');
        $status_text = $row['status'] == 1 ? 'Confirmed' : ($row['status'] == 2 ? 'Cancelled' : 'Pending');
      ?>
      <div class="booking-row">
        <div>
          <strong><?php echo $row['title'] ?></strong>
          <small><?php echo $row['name'] ?> | <?php echo date('M d, Y', strtotime($row['schedule'])) ?></small>
        </div>
        <span class="status-pill <?php echo $status_class ?>"><?php echo $status_text ?></span>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-muted mb-0">No booking requests yet.</p>
    <?php endif; ?>
  </section>
  <aside class="admin-card">
    <h3>Package Overview</h3>
    <?php while($row = $top_packages->fetch_assoc()): ?>
    <div class="package-mini">
      <img src="<?php echo package_cover($row) ?>" alt="">
      <div>
        <strong><?php echo $row['title'] ?></strong>
        <small><?php echo $row['tour_location'] ?></small>
        <small><?php echo number_format($row['total_bookings']) ?> bookings | Rs. <?php echo number_format($row['cost']) ?></small>
      </div>
    </div>
    <?php endwhile; ?>
  </aside>
</div>
