    
</section>
<section class="page-section section-soft">
    <div class="container">
    <div class="section-heading-row">
        <div>
            <p class="section-kicker">Your trips</p>
            <h2 class="section-title">Booked Packages</h2>
        </div>
        <a href="./?page=edit_account" class="btn btn-primary"><i class="fa fa-user-cog"></i> Manage Account</a>
    </div>
    <div class="account-panel table-responsive">
        <table class="table table-striped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>Package</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT b.*,p.title FROM book_list b inner join `packages` p on p.id = b.package_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");
                    while($row= $qry->fetch_assoc()):
                        $booking_status = (int)$row['status'];
                        $review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['package_id']}' and user_id = ".$_settings->userdata('id'))->num_rows;
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("Y-m-d",strtotime($row['schedule'])) ?></td>
                        <td class="text-center">
                            <?php if($booking_status === 0): ?>
                                <span class="booking-status-pill pending">Pending</span>
                            <?php elseif($booking_status === 1): ?>
                                <span class="booking-status-pill booked">Booked</span>
                            <?php elseif($booking_status === 2): ?>
                                <span class="booking-status-pill cancelled">Cancelled</span>
                            <?php elseif($booking_status === 3): ?>
                                <span class="booking-status-pill done">Done</span>
                            <?php else: ?>
                                <span class="booking-status-pill pending">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <?php if($booking_status === 0): ?>
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel Request</a>
                                </div>
                            <?php elseif($booking_status === 1): ?>
                                <span class="booking-action-lock"><i class="fa fa-check-circle"></i> Booked</span>
                            <?php elseif($booking_status === 2): ?>
                                <span class="booking-action-lock"><i class="fa fa-lock"></i> Locked</span>
                            <?php elseif($booking_status === 3 && $review <= 0): ?>
                                <button type="button" class="btn btn-flat btn-primary btn-sm submit_review" data-id="<?php echo $row['package_id'] ?>">Submit Review</button>
                            <?php else: ?>
                                <span class="booking-action-lock"><i class="fa fa-check"></i> Completed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    </div>
</section>
<script>
    function cancel_book($id){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_book_status",
            method:"POST",
            data:{id:$id,status:2},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Book cancelled successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('.cancel_data').click(function(){
            _conf("Are you sure to cancel this booking?","cancel_book",[$(this).data('id')])
        })
        $('.submit_review').click(function(){
            uni_modal("Rate & Feedback","./rate_review.php?id="+$(this).data('id'),'mid-large')
        })
        $('table').dataTable();
    })
</script>
