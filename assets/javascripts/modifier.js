$(document).ready(function(){

	const base_url = '/archives/';

	// buttons
	$('.modifier').click(function(e){
		$('#modal-content').html(' . . .');

		//file upload
		if($(this).attr('id')==='file'){
			if($(this).attr('cat')!='' && $(this).attr('data-parent')!=''){
				// set date
				const currentLocation=window.top.location.toString();
				let d = new Date();
				// expire within a minute
    			d.setTime(d.getTime() + (3600*100));
				const expires = "expires="+ d.toUTCString();
				   
				// set credentials
				document.cookie='dms-upload-id='+$(this).attr('data-cat')+';'+expires+';path=/'
				document.cookie='dms-upload-cat='+$(this).attr('data-parent')+';'+expires+';path=/'
				document.cookie='dms-upload-redirect-to='+ encodeURIComponent(currentLocation)+';'+expires+';path=/'
				// path
				window.location=base_url+'form/upload_multiple'
			}
		}

		if($(this).attr('data-menu')==='remove-item'){
			$('#modal-content').load(base_url+'modal/remove/?id='+$(this).attr('data-cat'));
		}

		if($(this).attr('data-menu')==='remove-file'){
			$('#modal-content').load(base_url+'modal/remove_file/?id='+$(this).attr('id'));
		}

	})

	// file download
	$('.download').click(function(){
		const id= ($(this).attr('data-cat'))
		const multiple = ($(this).attr('data-multiple'))
		window.open(base_url+'rest/file_download/?id='+id+`${multiple ? '&multiple=true' : ''}`);
	})


	function addToCustomPrinting(element){
		const element_attr = ($(element.currentTarget).attr('name'));
		const target = $('#print_button');
		const target_attr = (target.attr('data-custom'))
		let target_attr_array = target_attr.split(',')
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

