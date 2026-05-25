<script>
  $(document).ready(function(){
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
<footer class="main-footer text-sm">
  <strong>Copyright &copy; <?php echo date('Y') ?> Explore India Tours.</strong>
  <span>All rights reserved.</span>
  <div class="float-right d-none d-sm-inline-block">
    <b>Developed By : Project Team</b>
  </div>
</footer>
</div>
<script>
  $.widget && $.widget.bridge && $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
