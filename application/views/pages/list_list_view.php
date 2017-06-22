
<?php for($x=0; $x<count($items['data']); $x++): ?>
<div class="well-custom" id="item<?php echo $items['data'][$x]->id; ?>">
	
	<h3><a href="<?php echo base_url(); ?>?item_id=<?php echo $items['data'][$x]->id; ?>&id=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>"><?php echo $items['data'][$x]->document_title; ?></a>
	
		<span class="text-muted" title="open in new tab" style="cursor:pointer;" onclick='window.open("<?php echo base_url(); ?>?item_id=<?php echo $items['data'][$x]->id; ?>&id=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>");'><i class="material-icons md-18">open_in_new</i></span>
	</h3>
	
	
	<p class="display-description  display-field"><?php echo nl2br($items['data'][$x]->content_description); ?></p>

	<?php if(!empty($items['data'][$x]->original_file_name)){ ?>
		<p  class="display-menu  display-field">
			

			<?php echo $items['data'][$x]->original_file_name; ?> 
			<button class="btn btn-xs btn-success download" data-cat="<?php echo $items['data'][$x]->id; ?>"><i class="material-icons">cloud_download</i></button>
		</p>
	<?php } ?>


	<?php if(strlen(trim($items['data'][$x]->keywords))>0){ ?><p class="text-muted display-keywords  display-field"><br/><small><b><span class="glyphicon glyphicon-tags"></span></b>&nbsp; <?php echo $items['data'][$x]->keywords; ?> </small></p><?php } ?>


</div>

<?php endfor; ?>
