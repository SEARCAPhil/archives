<?php 	
	$page=$this->input->get('page',true)!=null?$this->input->get('page',true):1; 
	$id=($this->input->get('id',true)); 

	$search_param=@strip_tags(htmlentities(htmlspecialchars(utf8_encode($param['search']))));

?>

<div class="col col-lg-10 col-sm-9 col-md-9 col-xs-12 pull-right document-header">
	<div class="text-muted  text-center	 col col-lg-3 col-md-6 col-sm-6 col-xs-6" style="border-right: 1px solid rgb(240,240,240);">
		<h3><b><u><?php echo isset($items['total'])?$items['total']:0; ?></u> <i class="material-icons md-24">insert_drive_files</i></b></h3>
		<p><small><span class="glyphicon glyphicon-search"></span> Total search results found</small></p>

	</div>

	<div class="text-muted  col-lg-3 col-md-6 col-sm-6 col-xs-6 text-center" onclick="window.open('report/search/?search=<?php echo $search_param; ?>&page=<?php echo $page; ?>');">
		<h3><b> <i class="material-icons md-36">print</i></b></h3>
		<p>PRINT</p>

	</div>
</div>



<?php 
	#if no result
	if(count($items)<=0){ 
?>

			<center class="text-muted"><h1>Content Unavailable</h1></center>
		<?php  } ?>





<div class=" table-responsive col col-md-8 col-md-offset-1 ">


<?php if(@$_COOKIE['dms-view']=='table'){ ?>
		<table class="table table-striped table-hovered  tablesorter" id="listTable" style="font-size: 0.95em; border:1px solid rgb(220,220,220);border-radius: 5% !important;">
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
					<td colspan="8" class="text-muted text-right"><span class="glyphicon glyphicon-th-list"></span> Results based on selected category</td>
				</tr>

			</tfoot>
			<tbody>

				<?php for($x=0; $x<count($items['data']); $x++): ?>

					<tr>
						<td class="display-record_number  display-field"><?php echo $items['data'][$x]->id; ?></td>
						<td>
							<a href="<?php echo base_url(); ?>?item_id=<?php echo @$items['data'][$x]->id; ?>&id=<?php echo $items['data'][$x]->cat_id; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>"><?php echo $items['data'][$x]->document_title; ?></a>
						</td>
						<td class="display-description  display-field"><?php echo nl2br($items['data'][$x]->content_description); ?></td>
						<td  class="display-keywords  display-field"><?php echo $items['data'][$x]->keywords; ?></td>
						<td  class="display-files  display-field"><?php echo $items['data'][$x]->original_file_name; ?></td>
						<td class="display-menu  display-field">
							<?php if(!empty($items['data'][$x]->original_file_name)){ ?>
							<!--<p><a href="#"><span class="glyphicon glyphicon-print"></span></a></p>-->
								<p title="download"><a href="#"  class="download" data-cat="<?php echo $items['data'][$x]->id; ?>"><span class="glyphicon glyphicon-download"></span></a></p>
							<?php } ?>

							<span class="text-muted" title="open in new tab" style="cursor:pointer;" onclick='window.open("?item_id=<?php echo $items['data'][$x]->id; ?>&title=<?php echo $items['data'][$x]->document_title; ?>&id=<?php echo @$items['data'][$x]->cat_id; ?>");'><i class="material-icons md-18">open_in_new</i></span>

						</td>
						
					</tr>
				<?php endfor; ?>

				
			</tbody>
		</table>
		<?php }else{ ?>

			<?php  for($x=0; $x<count($items['data']); $x++): ?>
			<div class="well-custom" id="item<?php echo $items['data'][$x]->id; ?>">
				<p>
					<li class="dropdown list-unstyled pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons pull-right">keyboard_arrow_down</i></a>
					<ul class="dropdown dropdown-menu">

						<li class="" >
								<a href="<?php echo base_url(); ?>form/?item_id=<?php echo $items['data'][$x]->id; ?>&id=<?php echo @$items['data'][$x]->cat_id; ?>" class="modifier" data-menu="update" data-cat="<?php echo $items['data'][$x]->id; ?>">Update</a>
							</li>
							<li class="" data-toggle="modal" data-target="#myModal">
								<a href="#" class="modifier" id="file" data-menu="update" data-cat="<?php echo $items['data'][$x]->id; ?>" data-parent="attach">Attach File</a>
							</li>
							<li class="" data-toggle="modal" data-target="#myModal">
								<a href="#" class="modifier" data-menu="remove" data-toggle="modal" data-cat="<?php echo $items['data'][$x]->id; ?>">Remove</a>
							</li>
						
					</ul>
				</li>

				</p>


				<h4>
					<a href="?item_id=<?php echo $items['data'][$x]->id; ?>&title=<?php echo $items['data'][$x]->document_title; ?>&id=<?php echo @$items['data'][$x]->cat_id; ?>">
						
						<?php echo ucwords(str_ireplace(trim($search_param),'<mark>'.ucwords($search_param).'</mark>',$items['data'][$x]->document_title)); ?>
					</a>

					<span class="text-muted" title="open in new tab" style="cursor:pointer;" onclick='window.open("?item_id=<?php echo $items['data'][$x]->id; ?>&title=<?php echo $items['data'][$x]->document_title; ?>&id=<?php echo @$items['data'][$x]->cat_id; ?>");'><i class="material-icons md-18">open_in_new</i></span>

				</h4>

				<p class="display-description  display-field"><?php echo ucwords(str_ireplace(trim($search_param),'<mark>'.ucwords($search_param).'</mark>',$items['data'][$x]->content_description)); ?></p>

				<?php if(!empty($items['data'][$x]->original_file_name)){ ?>
				<p class="display-files  display-field"><small> <button class="btn btn-xs btn-success download" data-cat="<?php echo $items['data'][$x]->id; ?>"><i class="material-icons">cloud_download</i> <?php echo $items['data'][$x]->original_file_name; ?></button></small></p>
				<?php } ?>

				<br/><br/>

				<?php if(strlen(trim($items['data'][$x]->keywords))>0){ ?><p class="text-muted  display-keywords  display-field"><small><b><span class="glyphicon glyphicon-tags"></span> Tags</b>( <?php echo $items['data'][$x]->keywords; ?>)</small></p><br/> <?php } ?>
			</div>

			<?php endfor; ?>

		<?php } ?>


<?php 
	#if no result
	if(count($items)>0){ 
?>

		<div class="col-md-12 text-center">
			<nav class="pages">
					<ul class="pagination">
						<li>
							<a href="#" aria-label="Previous"><span>Page <?php echo $items['current_page']; ?> of <?php echo $items['pages']; ?></span>
			  					<span aria-hidden="true">«</span>
			 				</a>
						</li>
							
					
							 <?php  $original_page=$items['pages']; if($page-10>0){  $page_nav=$page-10;  }else{$page_nav=$items['pages']-5;} $tracker=0; $data_pages=$items['pages']; while($data_pages>0){ --$data_pages; $page_nav++; $tracker++;  ?>
		    			
		    				<?php if($tracker<20 && $page_nav<=$original_page&&$page>10){ ?>
		    					<li class="page-navigation <?php page_indicator($page_nav,$page); ?>"><a href="?page=<?php echo $page_nav; ?>&search=<?php echo @$param['search']; ?>"><?php echo $page_nav;  ?></a></li>
		    			
		    				<?php } ?>

		    				<?php  if($page<=10&&$tracker<=10){ ?>
		    					<li class="page-navigation <?php page_indicator($tracker,$page); ?>"><a href="?id=<?php echo $page; ?>&page=<?php echo $tracker;  ?>&search=<?php echo @$param['search']; ?>"><?php echo $tracker;  ?></a></li>
		    					
		    				<?php } ?>

		    			<?php } ?>
		    			
		    			<?php if($page_nav>20&&$page+10<$original_page-2){ ?>
		    			<?php $page_nav=$original_page>0?$original_page:1; ?>
		    					<li class="page-navigation disabled"><a href="#">. . .</a></li>
		    					<li class="page-navigation <?php page_indicator($original_page-1,$page); ?>" ><a href="?id=<?php echo $id; ?>&page=<?php echo $original_page-1;  ?>&search=<?php echo @$param['search']; ?>"><?php echo $original_page-1;  ?></a></li>
		    					<li class="page-navigation <?php page_indicator($original_page,$page); ?>"><a href="?id=<?php echo $page; ?>&page=<?php echo $original_page;  ?>&search=<?php echo @$param['search']; ?>"><?php echo $original_page;  ?></a></li>
		    			<?php } ?>
						
								
					
						 <li>


		  				<a href="?id=<?php echo $id; ?>&page=<?php echo $original_page;  ?>&search=<?php echo @$param['search']; ?>" aria-label="Next">
		   					<span aria-hidden="true">»</span>
		 				 </a>
					</li>
					 </ul>

			</nav>
						
		</div>

<?php } ?>


	</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">
     
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo site_url().'assets/javascripts/modifier.js'; ?>"></script>