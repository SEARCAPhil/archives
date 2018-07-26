/*GET COOKIE*/
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

	/**
	*Site URL
	*
	*This must match against CodeIgniter's site URL
	*/

	var site_url='/archives/';

	var redirect_url=getCookie('dms-upload-redirect-to')!=undefined?getCookie('dms-upload-redirect-to'):site_url+'form/success';

	$('#skip').attr('onclick','window.location="'+decodeURIComponent(redirect_url)+'"');


    $('.progress-div').hide();
    

    // read file info
    const readFileInfo = (file) => {
        const reader = new FileReader();
        const name = file.name;
        const type = file.type;
        const size = file.size;
        const whitelistFile=['jpg','jpeg','gif','bmp','pdf','png'];
        const filteredFileExtension = [];

        return new Promise((resolve, reject) => {
            //100Mb
		    if(size>1000000000){
               reject('File must not exceed 100MB') 
               return
            } 

             // read file
            reader.readAsDataURL(file);
            reader.onload = function(e){
                let fileSubStr = e.target.result.substr(0,30);

                // check file meta
                for(var x = 0; x < whitelistFile.length; x++){
                    if(e.target.result.substr(0,30).indexOf(whitelistFile[x])>=0){
                        filteredFileExtension.push(whitelistFile[x]);
                    }	
                }

                //if not exist in whitelist file
                if(filteredFileExtension.length <= 0){
                    reject('Invalid File Format!')
                } else {
                    resolve(file)
                }
            }
        })
    }


    const appendFileAttachment = (file, id) => {
        return new Promise((resolve, reject) => {
            try {
                const target = document.querySelector('.file-uploaded-section')
                const el = document.createElement('section')
                el.classList.add('row', 'col-12')
                el.style.marginBottom = '20px'
                el.id = id
                el.innerHTML = `
                    <div class="col col-lg-4 col-md-6">
                        <b>${file.name}</b><br/>
                        ${Math.round(file.size/1000)} KB
                    </div>

                    <div class="col col-lg-8 col-md-6">
                        <div class="progress progress-attachments">
                            <div class="progress-bar" role="progressbar" value="30" style="width:0%"></div>
                        </div>
                    </div>
                `
                target.append(el)
                resolve(file)
            } catch(err) {
                reject(err)
            }
        })

    }

    const showUploadError = (message, target) => {
        target.innerHTML = message
    }

    const uploadFile = (file, id) => {
        const formdata = new FormData();
        const target = document.getElementById(id)
        const xhr = new XMLHttpRequest()
        let progressbar = null
        formdata.append('file', file);
        //progressbar
        if (target) progressbar = target.querySelector('.progress-bar')

        try{
        // send
            xhr.open('POST',site_url+'form/file_multiple');
            xhr.onerror = (function(e) {
                showUploadError('<span class="text-danger">Unable to upload file</span.', progressbar.parentNode.parentNode)
            })

            xhr.upload.addEventListener('progress', function(e){ 
                if(e.lengthComputable){
                    const percentComplete = (e.loaded / e.total)*100.0;
                    progressbar.style.width = percentComplete+'%';

                    if(percentComplete===100){
                        //window.location='/dms/form/success';
                    }
                }
            })

            xhr.addEventListener('load',function(e){
                try{
                    var result = JSON.parse(e.target.responseText);
                    if(result.data!= undefined){
                        //redirect to original page or to success page
                        try{
                            if(getCookie('dms-upload-redirect-to')!=undefined){
                                showUploadError('<span class="text-success"><i class="material-icons">check</i> File successfully uploaded!</span.', progressbar.parentNode.parentNode)
                            }
                            
                        }catch(e){
                            showUploadError('<span class="text-danger"><i class="material-icons">clear</i> Unable to upload file</span.', progressbar.parentNode.parentNode)
                        }

                    }
                }catch(e){
                    showUploadError('<span class="text-danger"><i class="material-icons">clear</i> Unable to upload file</span.', progressbar.parentNode.parentNode)
                }
                
            })

            xhr.send(formdata)
        } catch(err) { 
            showUploadError('<span class="text-danger">Unable to upload file</span.', progressbar.parentNode.parentNode)
        }

        
       
    }
    
	$('#upload-file').change(function(e){
        const files = e.currentTarget.files
        for(let file of files) {
            readFileInfo(file).then(res => {
                // unique id section
                const id = new Date().getTime()+Math.random(0,100)
                // show in section
                appendFileAttachment(res, id).then(f => {
                    // upload
                    uploadFile(f, id)
                }).catch(err => {
                    // error
                    alert(err)
                })
            }).catch(err => {
                alert('Unable to upload some files. Please check their file size and type')
            })
        }


		
				//no error
				//var formdata = new FormData();
				//formdata.append('file',that.files[0]);

				//$('.file-div').hide();
				$('.progress-div').show();

				//post file
				/*var xhr=new XMLHttpRequest();
				xhr.open('POST',site_url+'form/file');

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
							//redirect to original page or to success page
							try{
								if(getCookie('dms-upload-redirect-to')!=undefined){
									window.location=decodeURIComponent(getCookie('dms-upload-redirect-to'));
								}
								
							}catch(e){
								//fallback
								window.location=site_url+'form/success'
							}

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

				xhr.send(formdata);*/

	
		

	})
})