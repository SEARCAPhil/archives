
<?php if(count($items['data'])>0){ ?><br/><br/>
<table class="table table-striped table-hovered  tablesorter table-responsive" id="listTable" style="font-size: 0.95em; border:1px solid rgb(220,220,220);border-radius: 5% !important;">
	<thead style="background: rgb(150,150,150); color: rgb(240,240,240);">
		<th class="display-record_number  display-field">Record Number</th>
		<th width="30%">Title</th>
		<th class="display-description  display-field">Desription</th>
		<th class="display-keywords  display-field">Keywords</th>
		<th class="display-files  display-field">Files</th>
		<th  class="display-menu  display-field"></th>
	</thead>
	<tfoot>
		<tr>
			<td colspan="8" class="text-muted"><span class="glyphicon glyphicon-th-list"></span> Results based on selected category</td>
		</tr>

	</tfoot>
	<tbody>

		<?php for($x=0; $x<count($items['data']); $x++): ?>
			<tr>
				<td class="display-record_number  display-field"><?php echo $items['data'][$x]->id; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>?item_id=<?php echo $items['data'][$x]->id; ?>&id=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>"><?php echo nl2br($items['data'][$x]->document_title); ?></a>

					<?php if(empty($items['data'][$x]->document_title)): ?>
						<a href="<?php echo base_url(); ?>?item_id=<?php echo $items['data'][$x]->id; ?>&id=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>">UNTITLED</a>
					<?php endif; ?>
				</td>
				<td class="display-description  display-field"><?php echo nl2br($items['data'][$x]->content_description); ?></td>
				<td class="display-keywords  display-field"><?php echo $items['data'][$x]->keywords; ?></td>
				<td class="display-files  display-field"><?php echo $items['data'][$x]->original_file_name; ?></td>
				<td class="display-menu  display-field">
					<!--<div class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-print"></span></a>
						<ul class="dropdown-menu pull-right">
							<li><a href="report/short/" target="_blank"><span class="glyphicon glyphicon-th-list"></span> Short</a></li>
							<li><a href="report/long/" target="_blank"><span class="glyphicon glyphicon-th"></span> Long</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Custom</a></li>
						</ul>

					</div><br/>-->
					<?php if(!empty($items['data'][$x]->original_file_name)){ ?>
					<p><a href="#"  class="download" data-cat="<?php echo $items['data'][$x]->id; ?>"><span class="glyphicon glyphicon-download"></span></a></p>
					<?php } ?>

					<span class="text-muted" title="open in new tab" style="cursor:pointer;" onclick='window.open("<?php echo base_url(); ?>?item_id=<?php echo $items['data'][$x]->id; ?>&id=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>");'><i class="material-icons md-18">open_in_new</i></span>
				</td>
				
			</tr>
		<?php endfor; ?>

		
	</tbody>
</table>

<?php } ?>