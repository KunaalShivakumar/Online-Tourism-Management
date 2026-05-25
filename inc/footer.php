<script>
  $(document).ready(function(){
    $('#p_use').click(function(){
      uni_modal("Privacy Policy","policy.php","mid-large")
    })
    window.viewer_modal = function($src = ''){
      start_loader()
      var ext = $src.split('.').pop()
      var view = ext == 'mp4' ? $("<video src='"+$src+"' controls autoplay></video>") : $("<img src='"+$src+"' />")
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
        show:true,
        backdrop:'static',
        keyboard:false,
        focus:true
      })
      end_loader()
    }
    window.uni_modal = function($title = '' , $url='',$size=""){
      start_loader()
      $.ajax({
        url:$url,
        error:err=>{
          console.log(err)
          alert("An error occured")
          end_loader()
        },
        success:function(resp){
          if(resp){
            $('#uni_modal .modal-title').html($title)
            $('#uni_modal .modal-body').html(resp)
            if($size != ''){
              $('#uni_modal .modal-dialog').removeAttr("class").addClass('modal-dialog '+$size+' modal-dialog-centered')
            }else{
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
            }
            $('#uni_modal').modal({
              show:true,
              backdrop:'static',
              keyboard:false,
              focus:true
            })
          }
          end_loader()
        }
      })
    }
    window._conf = function($msg='',$func='',$params = []){
      $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
      $('#confirm_modal .modal-body').html($msg)
      $('#confirm_modal').modal('show')
    }
  })
</script>
<footer class="footer py-4">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-4 text-lg-left">Copyright &copy; Explore India <?php echo date('Y') ?></div>
			<div class="col-lg-4 my-3 my-lg-0">
				<a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
				<a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
				<a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<div class="col-lg-4 text-lg-right">
				<a class="link-dark text-decoration-none mr-3" href="javascript:void(0)" id="p_use">Privacy Policy</a>
        <strong>Developed By : Project Team</strong>
			</div>
		</div>
	</div>
</footer>
<script>
  $.widget && $.widget.bridge && $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
