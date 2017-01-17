$(document).ready(function(){
	$('.progress-div').hide();
	$('#upload-file').change(function(e){
		
		var reader=new FileReader();
		var name=this.files[0].name;
		var type=this.files[0].type;
		var size=this.files[0].size;
		var that=this;
		var whitelistFile=['jpg','jpeg','gif','bmp','pdf','png'];
		var filteredFileExtension=[];


		//10Mb
		if(size>10000000){
			alert('File must not exceed 10MB');
			return 0;
		}

		reader.readAsDataURL(this.files[0]);
		reader.onload=function(e){
			var fileSubStr=e.target.result.substr(0,30);

			for(var x=0;x<whitelistFile.length;x++){

				if(e.target.result.substr(0,30).indexOf(whitelistFile[x])>=0){
					filteredFileExtension.push(whitelistFile[x]);
					
				}
				

			}

			//if not exist in whitelist file
			if(filteredFileExtension.length<=0){
				alert('Invalid File Format!');	
				return;
			}else{

				//no error
				var formdata=new FormData();
				formdata.append('file',that.files[0]);



				$('.file-div').hide();
				$('.progress-div').show();


				//post file

				var xhr=new XMLHttpRequest();
				xhr.open('POST','/dms/form/file');

				xhr.upload.addEventListener('progress',function(e){
					console.log(e);
					if(e.lengthComputable){
						var percentComplete = (e.loaded / e.total)*100.0;
		      		  	document.querySelectorAll('div.progressMeter')[0].style.width=percentComplete+'%';
		      		  	if(percentComplete===100){
		      		  		//window.location='/dms/form/success';
		      		  	}
					}
				});

				xhr.addEventListener('load',function(e){
					try{
						var result= JSON.parse(e.target.responseText);
						if(result.data!= undefined){
							window.location='/dms/form/success'
						}else{
							if(result.error!= undefined){

								$('.file-div').show();
								$('.progress-div').hide();
								$('#upload-error').html(result.error);
							}
						}
					}catch(e){

					}
					
				});

				xhr.send(formdata);

			}
			
		}

		

	})
})