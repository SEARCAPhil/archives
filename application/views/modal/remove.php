<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Remove Item</h4>
</div>
<div class="modal-body">
  <p>All files associated in this item will be deleted.Are you sure you want to remove this item?</p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-dismiss-button">Cancel</button>
  <button type="button" class="btn btn-danger" data-cat="<?php echo (int) @htmlentities(htmlspecialchars($_GET['id'])); ?>" id="remove-continue" >Continue</button>
</div>

<script type="text/javascript">
$(document).ready(function(){
  
  $('#remove-continue').click(function(){

    var that=this;
    var id=$(this).attr('data-cat')
    var data={'id':id}
    data=JSON.stringify(data);
    

    $(that).attr('disabled','disabled');

    $.post('rest/remove',data).success(function(e){
      if(e==1){

        $('#modal-dismiss-button').click();
        
        setTimeout(function(){ $('#item'+id).fadeOut(); },1000);
      }else{
        alert('oops!something went wrong.Please try again later.')
      }

    })
  })
})

</script>