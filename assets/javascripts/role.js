
$('.checkbox-group').click(function(){
	var attr=($(this).attr('class'))
	var attr_array=attr.split(' ');

	try{
		var class_name=(attr_array[attr_array.length-1])

		//check all children
		if(this.checked){
			$('.'+class_name).prop('checked',true);	
		}else{
			$('.'+class_name).prop('checked',false);
		}
		

	}catch(e){}


})



$('.checkbox-group-all').click(function(){
	/*//check all groupbox
		if(this.checked){
			
			$('.checkbox-group').prop('checked',true);	

		}else{
			$('.checkbox-group').prop('checked',false);
		}
	*/


	var check_groups=document.querySelectorAll('.checkbox-group-parents');
	for(var x=0; x<check_groups.length; x++ ){

		//do not check already checked
		if(this.checked){
			if(!check_groups[x].checked){
				check_groups[x].click()
			}
		}else{
			if(check_groups[x].checked){
				check_groups[x].click()
			}
		}
	}
		

		
})


$('.checkbox-group-grant-read').click(function(){

	$('.checkbox-group-set-read').click();
	
})


$('.checkbox-group-grant-write').click(function(){

	$('.checkbox-group-set-write').click();
})

$('.checkbox-group-grant-update').click(function(){

	$('.checkbox-group-set-update').click();
})

$('.checkbox-group-grant-remove').click(function(){
	$('.checkbox-group-set-remove').click();
})


$('.checkbox-group-set-read').click(function(e){
	var id=$(this).attr('data-parent')

	var target=$('#'+id);

	//disable selection
	if(!target[0].checked){
		this.checked=false;
		return 0;
	} 


	if(this.checked){
		target.attr('data-read',1)
	}else{
		target.attr('data-read',0)
	}
})

$('.checkbox-group-set-write').click(function(){
	var id=$(this).attr('data-parent')
	var target=$('#'+id);

	//disable selection
	if(!target[0].checked){
		this.checked=false;
		return 0;
	}

	if(this.checked){
		target.attr('data-write',1)
	}else{
		target.attr('data-write',0)
	}
})

$('.checkbox-group-set-update').click(function(){
	var id=$(this).attr('data-parent')

	var target=$('#'+id);

	//disable selection
	if(!target[0].checked){
		this.checked=false;
		return 0;
	}

	if(this.checked){
		target.attr('data-update',1)
	}else{
		target.attr('data-update',0)
	}
})

$('.checkbox-group-set-remove').click(function(){
	var id=$(this).attr('data-parent')
	var target=$('#'+id);

	//disable selection
	if(!target[0].checked){
		this.checked=false;
		return 0;
	}

	if(this.checked){
		target.attr('data-remove',1)
	}else{
		target.attr('data-remove',0)
	}
})

function ajax_sendPrivilege(id,json,callback){
	$.post('../role/privilege',{id:id,data:json},function(data){
		callback(data)
	})
}

$('.save-button').click(function(){

	$('.modal-content-body').html('<center>Setting up. . .</center>'); //clear content 
	$('.modal-content-body').load('../modal/applying_changes');
	var role_id=$('div[name="role"]').attr('data-content');
	var group=($('.checkbox-group'));
	var group_filter=new Array();
	for(var x=0; x<group.length; x++){
		if(group[x].checked){
			var data={
				id:group[x].id,
				read:$(group[x]).attr('data-read')==undefined?0:$(group[x]).attr('data-read'),
				write:$(group[x]).attr('data-write')==undefined?0:$(group[x]).attr('data-write'),
				update:$(group[x]).attr('data-update')==undefined?0:$(group[x]).attr('data-update'),
				delete:$(group[x]).attr('data-remove')==undefined?0:$(group[x]).attr('data-remove')
			}
			
			group_filter.push(data)
		}	
	}

	//stop if role id is not present
	if(role_id<0||role_id.length<1) return 0;

	ajax_sendPrivilege(role_id,JSON.stringify(group_filter),function(response){

		var data=JSON.parse(response);

		if(typeof data.status==undefined){ alert('Oops!Something went wrong. Please try again later'); return 0; }
		
		//success
		if(data.status==200){

			//success html
			$('.modal-content-body').html('<center><h3 class="text-success">Changes Applied <span class="glyphicon glyphicon-ok"></span></h3></center>')

			setTimeout(function(){
				$('.modal').fadeOut();	
			},2000)
			
		}else{
			alert('Oops!Something went wrong. Please try again later'); return 0;
		}
		
		
	})



})

