<div class="container">
	

	<div class=" table-responsive col col-md-9 col-md-offset-3 ">
		<br/><br/><br/>
		<h3><span class="glyphicon glyphicon-cloud-upload"></span> Step 2/2  <span class="text-muted">(File Upload)</span> <span class="pull-right"> <button class="btn btn-success" onclick="window.location='<?php echo base_url().'form/success'; ?>';">Skip &raquo;</button></span></h3>
	
		<p class="text-muted">Please select a file with png, jpg, gif, bmp, or pdf file extension only. Uploading will overwrite the old ones with the newly attached file and will leave the old file permanently unaccessible. You may wish to backup the file before proceeding to prevent any damage or undesirable loss. 
		</p>
	</div>

	<div class="col col-md-9 col-md-offset-3 file-div">
		<center>
			<h3 class="page-header">Please select a file</h3>
			<h1><span class="glyphicon glyphicon-paperclip" style="cursor: pointer;" id="upload-file-button" onclick="document.getElementById('upload-file').click()"></span></h1>
			<p>You can upload up to 10MB of image or pdf file</p>
			<p><form id="upload-file-form"><input type="file" name="file" id="upload-file" class="sr-only"></form></p>
			

		</center>
	</div>

	<div class="col col-md-5 col-md-offset-3 progress-div ">
		<p>Uploading . . .</p>
		<div class="progress">
			<div class="progress-bar progressMeter"></div>
			<span class="progress-indicator sr-only">% completed</span>
		</div>
	</div>
	<div id="upload-error" class="col col-md-9 col-md-offset-1" style="color:red !important;text-align: center;"></div>

<script src="<?php echo base_url(); ?>assets/javascripts/upload.js"></script>