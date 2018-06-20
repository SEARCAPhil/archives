<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Remove Attachment</h4>
</div>
<div class="modal-body">
  <p>This file will be deleted permanently. are you sure you want to continue?</p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-dismiss-button">No</button>
  <button type="button" class="btn btn-danger" data-file="<?php echo (int) @htmlentities(htmlspecialchars($_GET['id'])); ?>" id="remove-continue" >Yes</button>
</div>

<script type="text/javascript">
$(document).ready(function(){
  
  $('#remove-continue').click(function(){
    const id = $(this).attr('data-file')
    let that = this;
    let data = { id }
    data = JSON.stringify(data);
    

    $(that).attr('disabled','disabled');

    $.post('rest/remove_attachment',data).success(function(e){
      if(e==1){
        $('#modal-dismiss-button').click();
        $('.item-status').html( `<center class="text-danger"><h2>Deleted</h2><p>All files associated with this item were deleted.</p></center>`) 
        $('.file'+id).remove()

      }else{
        alert('oops!something went wrong.Please try again later.')
      }

    })
  })
})

</script>