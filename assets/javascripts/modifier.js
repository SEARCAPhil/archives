$(document).ready(function(){
	$('.modifier').click(function(e){
		$('#modal-content').html(' . . .');

		//file upload
		if($(this).attr('id')==='file'){
			if($(this).attr('cat')!='' && $(this).attr('data-parent')!=''){
				 var d = new Date();
    			d.setTime(d.getTime() + (3600*100));
   				var expires = "expires="+ d.toUTCString();

				document.cookie='dms-upload-id='+$(this).attr('data-cat')+';'+expires+';path=/'
				document.cookie='dms-upload-cat='+$(this).attr('data-parent')+';'+expires+';path=/'

				window.location='/dms/form/upload'
			}
		}else{
			$('#modal-content').load('/dms/modal/remove/?id='+$(this).attr('data-cat'));
		}

		


	})

	$('.download').click(function(){
		var id=($(this).attr('data-cat'))
		/*$.get('/dms/rest/file_download/?id='+id).success(function(){

		})*/
		window.open('/dms/rest/file_download/?id='+id);
	})
})

