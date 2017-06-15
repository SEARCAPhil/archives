
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}




$(document).ready(function(){
	var report_field=[];
	

	$('.report-field').change(function(){

		
		if($(this)[0].checked==true){
			report_field[$(this).attr('data-sort')]=($(this).attr('name'));
			$('.display-'+$(this).attr('name')).show();
		}else{
			delete report_field[$(this).attr('data-sort')];
			$('.display-'+$(this).attr('name')).hide();
			//report_field.splice(report_field.indexOf($(this).attr('name')),1);
			
		}

		document.cookie="report_field="+JSON.stringify({report_field})+';path=/';
		
	})

	try{
		var cookies_report=getCookie('report_field')

		var cookie_json_report=JSON.parse(cookies_report)



		for(var x=0; x<cookie_json_report.report_field.length; x++){
			
			if(cookie_json_report.report_field[x]!=''){
				report_field.push(cookie_json_report.report_field[x]);
				$('.report-field[name="'+cookie_json_report.report_field[x]+'"]').attr('checked','checked');
				$('.display-'+cookie_json_report.report_field[x]).show();
			}
		}

	}catch(e){
		
		for(var x=0; x<$('.report-field').length; x++){

			report_field[$('.report-field')[x].getAttribute('data-sort')]=($('.report-field')[x].getAttribute('name'));
		}
		document.cookie="report_field="+JSON.stringify({report_field})+';path=/';
		$('.report-field').attr('checked','checked');
		$('.display-field').show();

	}


})
