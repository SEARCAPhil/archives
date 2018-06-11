$(document).ready(function(){

	var base_url='/archives/';

	$('.modifier').click(function(e){
		$('#modal-content').html(' . . .');

		//file upload
		if($(this).attr('id')==='file'){
			if($(this).attr('cat')!='' && $(this).attr('data-parent')!=''){
				 var d = new Date();
				 var currentLocation=window.top.location.toString();
    			d.setTime(d.getTime() + (3600*100));
   				var expires = "expires="+ d.toUTCString();

				document.cookie='dms-upload-id='+$(this).attr('data-cat')+';'+expires+';path=/'
				document.cookie='dms-upload-cat='+$(this).attr('data-parent')+';'+expires+';path=/'
				document.cookie='dms-upload-redirect-to='+encodeURIComponent(currentLocation)+';'+expires+';path=/'

				

				window.location=base_url+'form/upload'


			}
		}else{
			$('#modal-content').load(base_url+'modal/remove/?id='+$(this).attr('data-cat'));
		}

		


	})

	$('.download').click(function(){
		var id=($(this).attr('data-cat'))
		/*$.get('/dms/rest/file_download/?id='+id).success(function(){

		})*/
		window.open(base_url+'rest/file_download/?id='+id);
	})


	function addToCustomPrinting(element){

		var element_attr=($(element.currentTarget).attr('name'));

		var target=$('#print_button');
		var target_attr=(target.attr('data-custom'))

		var target_attr_array=target_attr.split(',')

		


		//uncheked
		if(!element.currentTarget.checked){
			if(target_attr_array.indexOf(element_attr)>0){
				target_attr_array.splice(target_attr_array.indexOf(element_attr),1)
			}
		}else{

			//push
			target_attr_array.push(element_attr);
		}

		//add to target
		target.attr('data-custom',target_attr_array);
	}

	//custom printing

	$('.custom-print').on('click',function(e){
		
		if(!$(this).hasClass('active')){
			$(this).addClass('active');
			$('.custom-print-checkbox').show();
			$(this).css({background:'rebeccapurple',color:'rgb(255,255,255)'})
		}else{
			$(this).removeClass('active');
			$(this).css({background:'none',color:'rgb(60,60,60)'})
			$('.custom-print-checkbox').hide();

			//remove selected attr
			$('#print_button').attr('data-custom','');
		}

		$('.custom-print-checkbox > span > input.checkbox-group').off('change',addToCustomPrinting);
		$('.custom-print-checkbox > span > input.checkbox-group').on('change',addToCustomPrinting);


		//active state
		if($(this).hasClass('active')){
			var selected_attr_array=[];

			

			for(var x=0; x<$('.custom-print-checkbox > span > input.checkbox-group').length; x++){
				//add to filter if checked
				if($('.custom-print-checkbox > span > input.checkbox-group')[x].checked){
					selected_attr_array.push($($('.custom-print-checkbox > span > input.checkbox-group')[x]).attr('name'))
				}
			}


			$('#print_button').attr('data-custom',selected_attr_array);
		}

		

		
	})
})

