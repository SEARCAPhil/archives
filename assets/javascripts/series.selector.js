$(document).ready(function(){
	function selectSeries(a){
		console.log(a.target.selectedOptions[0].getAttribute('data-default'))
		var data={'id':this.value}
		data=JSON.stringify(data)

		var that=this;
		var index=0;
		$.post('/document_management_system/rest/series',data).success(function(e){
			index++;
			var series=JSON.parse(e)

			if(series.length>0){


				var htm='<div class="select'+that.value+'"><select class="form-control series series-sub" name="series" style="margin-top:5%;" id="'+index+'">';
				htm+='<option value='+that.value+' data-default="true">Select one</option>';
				for(var x=0;x<series.length;x++){
					htm+='<option value='+series[x].id+'>'+series[x].category+'</option>';
				}

				htm+='</select><div></div></div>';
				
				a.currentTarget.nextElementSibling.innerHTML='';
		
				a.currentTarget.nextElementSibling.innerHTML+=htm




			}
			

			

			setTimeout(function(){
				$('.series').off('change',selectSeries);
				$('.series').on('change',selectSeries);	
			},800)


		})

		
		
		
	}

	$('.main-series').change(function(){
		$('.series-result').html('');
	})

	$('.series').on('change',selectSeries);
})	
