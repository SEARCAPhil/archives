<?php 	
	$page=$this->input->get('page',true)!=null?$this->input->get('page',true):1; 
	$id=($this->input->get('id',true)); 
?>

<div class="container">
	<div class=" table-responsive col col-md-7 col-md-offset-2 ">
		<br/>
		<div class="row  text-center">
			<h1>&nbsp;Search results</h1>
			<h1><span class="glyphicon glyphicon-search"></span></h1>
			<h4><small><b><?php echo isset($items['total'])?$items['total']:0; ?></b> result(s) found</small></h4>
		</div>
	</div>
	<br/><br/><br/>
</div>


<?php 
	#if no result
	if(count($items)<=0){ 
?>

			<center class="text-muted"><h1>Content Unavailable</h1></center>
		<?php  } ?>


<div class="container ">


<div class=" table-responsive col col-md-9 col-md-offset-1 ">


<?php if(@$_COOKIE['dms-view']=='table'){ ?>
		<table class="table table-striped table-hovered  tablesorter" id="listTable" style="font-size: 0.95em; border:1px solid rgb(220,220,220);border-radius: 5% !important;">
			<thead style="background: rgb(150,150,150); color: rgb(240,240,240);">
				<th>Record Number</th>
				<th>Title</th>
				<th>Desription</th>
				<th>Encoded by</th>
				<th>Date Encoded</th>
				<th>Keywords</th>
				<th>Files</th>
				<th></th>
			</thead>
			<tfoot>
				<tr>
					<td colspan="8" class="text-muted text-right"><span class="glyphicon glyphicon-th-list"></span> Results based on selected category</td>
				</tr>

			</tfoot>
			<tbody>

				<?php for($x=0; $x<count($items['data']); $x++): ?>

					<tr>
						<td><?php echo $items['data'][$x]->id; ?></td>
						<td>
							<a href="<?php echo base_url(); ?>?id=<?php echo @$items['data'][$x]->id; ?>&parent=<?php echo $items['data'][$x]->cat_id; ?>&category=<?php echo $items['data'][$x]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>"><?php echo $items['data'][$x]->document_title; ?></a>
						</td>
						<td><?php echo $items['data'][$x]->content_description; ?></td>
						<td><?php echo $items['data'][$x]->encoded_by; ?></td>
						<td><?php echo $items['data'][$x]->date_of_input; ?></td>
						<td><?php echo $items['data'][$x]->keywords; ?></td>
						<td><?php echo $items['data'][$x]->original_file_name; ?></td>
						<td>
							<p><a href="#"><span class="glyphicon glyphicon-print"></span></a></p>
							<p><a href="#"><span class="glyphicon glyphicon-download"></span></a></p>
						</td>
						
					</tr>
				<?php endfor; ?>

				
			</tbody>
		</table>
		<?php }else{ ?>

			<?php  for($x=0; $x<count($items['data']); $x++): ?>
			<div  id="item<?php echo $items['data'][$x]->id; ?>">
				<p>
					<li class="dropdown list-unstyled pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
					<ul class="dropdown dropdown-menu">

						<li class="" >
								<a href="<?php echo base_url(); ?>form/?id=<?php echo $items['data'][$x]->id; ?>" class="modifier" data-menu="update" data-cat="<?php echo $items['data'][$x]->id; ?>">Update</a>
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
					<a href="?id=<?php echo $items['data'][$x]->id; ?>&title=<?php echo $items['data'][$x]->document_title; ?>">
						<span class="glyphicon glyphicon-bookmark"></span> 
						<?php echo $items['data'][$x]->document_title; ?>
					</a>
				</h4>


				<p><hr/></p>
				
				
				<p><b>Description</b></p>
				<p><?php echo $items['data'][$x]->content_description; ?></p>
				<p><small><span class="glyphicon glyphicon-file"></span> <?php echo $items['data'][$x]->original_file_name; ?> <button class="btn btn-xs btn-success download" data-cat="<?php echo $items['data'][$x]->id; ?>">Download</button></small></p><br/><br/>

				<?php if(strlen(trim($items['data'][$x]->keywords))>0){ ?><p class="text-muted"><small><b><span class="glyphicon glyphicon-tags"></span> Tags</b>( <?php echo $items['data'][$x]->keywords; ?>)</small></p><br/> <?php } ?>
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
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">
     
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo site_url().'assets/javascripts/modifier.js'; ?>"></script>