<style>
    .progress-attachments {
        background: #333333;
        height:10px;
    }
    .progress-attachments > .progress-bar {
        background: #26a65b;
    }
</style>
<div class="col col-md-7 col-sm-9 col-md-offset-1">
	<div class="col col-xs-12">
		<br/><br/><br/>
		<h3>
            <span class="glyphicon glyphicon-cloud-upload"></span> Step 2/2  <span class="text-muted">(File Upload)</span> <span class="pull-right"> 
                <button class="btn btn-dark form-success" id="skip">Skip &raquo;</button>
                <button class="btn btn-success form-success" id="skip">Done </button>
            </span>
        </h3>
	
		<p class="text-muted">Please select a file with png, jpg, gif, bmp, or pdf file extension only. Uploading will overwrite the old ones with the newly attached file and will leave the old file permanently unaccessible. You may wish to backup the file before proceeding to prevent any damage or undesirable loss. 
		</p>
	</div>

	<div class="col col-md-12 file-div">
		<section>
            <center>
                <h3 class="page-header">Please select files(s)</h3>
                <p>You can upload up to 10MB of image or pdf file</p>
                <h1><span class="glyphicon glyphicon-paperclip" style="cursor: pointer;" id="upload-file-button" onclick="document.getElementById('upload-file').click()"></span></h1>
                <p><form id="upload-file-form"><input type="file" name="file" id="upload-file" class="sr-only" multiple></form></p>
            </center>
            <br/><br/>    
            <div class="file-uploaded-section"></div>

		</section>
	</div>

<script src="<?php echo base_url(); ?>assets/javascripts/upload.multiple.js"></script>
<script>
    document.querySelectorAll('.form-success').forEach((el, index) => {
        el.addEventListener('click', () => {
            window.location = decodeURIComponent(getCookie('dms-upload-redirect-to'))
        })
    })    
</script>