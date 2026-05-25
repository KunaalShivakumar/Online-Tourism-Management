<div class="container-fluid">
    <form action="" id="book-form">
        <div class="form-group">
            <label class="control-label">Preferred travel date</label>
            <input name="package_id" type="hidden" value="<?php echo $_GET['package_id'] ?>" >
            <input type="date" class='form form-control' required name='schedule' min="<?php echo date('Y-m-d') ?>">
        </div>
        <div class="form-group text-right mb-0">
            <button class="btn btn-primary" type="submit"><i class="fa fa-calendar-check"></i> Send Booking Request</button>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=book_tour",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Book Request Successfully sent.")
                        $('.modal').modal('hide')
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>
