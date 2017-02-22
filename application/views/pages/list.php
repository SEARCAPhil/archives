<?php 	
	$page=$this->input->get('page',true)!=null?$this->input->get('page',true):1; 
	$id=($this->input->get('id',true)); 
?>
<div class="container">
	<?php /**if(count($data)>0):*/ ?>
	<!--<div class=" table-responsive col col-md-2 hidden-sm hidden-xs ">
		<div class="row">
			<div class="col col-md-12" style="max-height: 200px;overflow:hidden;">
				<img src="<?php echo base_url(); ?>assets/images/logo-new.png" width="100%"/>
			</div>
		</div>
		<div class="row">
			<br/>
			<div class="col col-md-12">
				<div class="list-group row">
					<?php for($x=0;$x<count($data);$x++){ ?>
						<a href="<?php echo base_url(); ?>?id=<?php echo $data[$x]->id; ?>&parent=<?php echo @$param['id']; ?>" class="list-group-item"><?php echo $data[$x]->category; ?> <small class="text-muted">(<?php echo $data[$x]->code; ?>)</small></a>
					<?php } ?>
				</div>
			</div>
		</div>
		
	</div>-->
	<?php /*endif;*/ ?>

	<div class=" table-responsive col col-md-10 col-md-offset-1 ">
		

		<?php if(count($details)>0){ ?>
		<h3><span class="glyphicon glyphicon-bookmark"></span> <?php echo $details[0]->category; ?> <span class="text-muted">(<?php echo $details[0]->code; ?>)</span></h3>
		<p class="text-muted"><?php echo ucfirst(utf8_encode($details[0]->description)); ?></p>
		<br/>
		<!--<h3><span class="glyphicon glyphicon-list"></span> List </h3>-->
		<br/>

		<?php 
			#if no result
			if(count(@$items['data'])<=0){ 
		?>

			<center class="text-muted"><h1>Content Unavailable</h1></center>
		<?php  } ?>

		<?php if(!isset($_COOKIE['dms-view'])){$_COOKIE['dms-view']='table';} ?>
		<?php if(@$_COOKIE['dms-view']=='table'){ ?>

				<?php if(count($items['data'])>0){ ?>
					<table class="table table-striped table-hovered  tablesorter table-responsive" id="listTable" style="font-size: 0.95em; border:1px solid rgb(220,220,220);border-radius: 5% !important;">
						<thead style="background: rgb(150,150,150); color: rgb(240,240,240);">
							<th>Record Number</th>
							<th width="30%">Title</th>
							<th>Desription</th>
							<th>Keywords</th>
							<th>Files</th>
							<th></th>
						</thead>
						<tfoot>
							<tr>
								<td colspan="8" class="text-muted"><span class="glyphicon glyphicon-th-list"></span> Results based on selected category</td>
							</tr>

						</tfoot>
						<tbody>

							<?php for($x=0; $x<count($items['data']); $x++): ?>
								<tr>
									<td><?php echo $items['data'][$x]->id; ?></td>
									<td>
										<a href="<?php echo base_url(); ?>?id=<?php echo $items['data'][$x]->id; ?>&parent=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>"><?php echo nl2br($items['data'][$x]->document_title); ?></a>
									</td>
									<td><?php echo nl2br($items['data'][$x]->content_description); ?></td>
									<td><?php echo $items['data'][$x]->keywords; ?></td>
									<td><?php echo $items['data'][$x]->original_file_name; ?></td>
									<td>
										<!--<div class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-print"></span></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="report/short/" target="_blank"><span class="glyphicon glyphicon-th-list"></span> Short</a></li>
												<li><a href="report/long/" target="_blank"><span class="glyphicon glyphicon-th"></span> Long</a></li>
												<li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Custom</a></li>
											</ul>

										</div><br/>-->
										<p><a href="#"  class="download" data-cat="<?php echo $items['data'][$x]->id; ?>"><span class="glyphicon glyphicon-download"></span></a></p>
									</td>
									
								</tr>
							<?php endfor; ?>

							
						</tbody>
					</table>
				<?php } ?>
		<?php }else{ ?>

			<?php for($x=0; $x<count($items['data']); $x++): ?>
			<div class="well-custom" id="item<?php echo $items['data'][$x]->id; ?>">
				<p>
					<li class="dropdown list-unstyled pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
					<ul class="dropdown dropdown-menu">
						
							<li class="" >
								<a href="<?php echo base_url(); ?>form/?id=<?php echo $items['data'][$x]->id; ?>" class="modifier" data-menu="update" data-cat="<?php echo $items['data'][$x]->id; ?>">Update</a>
							</li>
							<li class="" data-toggle="modal" data-target="#myModal">
								<a href="#" class="modifier" id="file" data-menu="update" data-cat="<?php echo $items['data'][$x]->id; ?>" data-parent="<?php echo @$details[0]->id; ?>">Attach File</a>
							</li>
							<li class="" data-toggle="modal" data-target="#myModal">
								<a href="#" class="modifier" data-menu="remove" data-toggle="modal" data-cat="<?php echo $items['data'][$x]->id; ?>">Remove</a>
							</li>
							
						
					</ul>
				</li>

				</p>
				<h4><a href="<?php echo base_url(); ?>?id=<?php echo $items['data'][$x]->id; ?>&parent=<?php echo $details[0]->id; ?>&category=<?php echo $details[0]->category; ?>&title=<?php echo urlencode(utf8_encode($items['data'][$x]->document_title)); ?>"><?php echo $items['data'][$x]->document_title; ?></a></h4>
				<p><hr/></p>
				
				<p><b>Description</b></p>
				<p><?php echo $items['data'][$x]->content_description; ?></p>
				<p>
					<span class="glyphicon glyphicon-file"></span> 
					<?php echo $items['data'][$x]->original_file_name; ?> 
					<button class="btn btn-xs btn-success download" data-cat="<?php echo $items['data'][$x]->id; ?>">Download</button>
				</p>


				<?php if(strlen(trim($items['data'][$x]->keywords))>0){ ?><p class="text-muted"><br/><small><b><span class="glyphicon glyphicon-tags"></span></b> <?php echo $items['data'][$x]->keywords; ?> </small></p><?php } ?>

			
			</div>

			<?php endfor; ?>

		<?php } ?>

<?php 
	#if no result
	if(count(@$items['data'])>0){ 

?>
		<div class="col-md-12 text-center">
			<nav class="pages">
					<ul class="pagination">
						<li>
							<a href="?id=<?php echo $id; ?>&page=1" aria-label="Previous"><span>Page <?php echo $items['current_page']>=1?$items['current_page']:1; ?> of <?php echo $items['pages']; ?></span>
			  					<span aria-hidden="true">«</span>
			 				</a>
						</li>
							
					
							 <?php  $original_page=$items['pages']; if($page-10>0){  $page_nav=$page-10;  }else{$page_nav=$items['pages']-5;} $tracker=0; $data_pages=$items['pages']; while($data_pages>0){ --$data_pages; $page_nav++; $tracker++;  ?>
		    			
		    				<?php if($tracker<20 && $page_nav<=$original_page&&$page>10){ ?>
		    					<li class="page-navigation <?php page_indicator($page_nav,$page); ?>" id="?id=<?php echo $id; ?>&page<?php echo $page_nav; ?>"><a href="?id=<?php echo $id; ?>&page=<?php echo $page_nav; ?>"><?php echo $page_nav;  ?></a></li>
		    			
		    				<?php } ?>

		    				<?php  if($page<=10&&$tracker<=10){ ?>
		    					<li class="page-navigation <?php page_indicator($tracker,$page); ?>" id="<?php echo $id; ?>&page<?php echo $page_nav; ?>"><a href="?id=<?php echo $id; ?>&page=<?php echo $tracker;  ?>"><?php echo $tracker;  ?></a></li>
		    					
		    				<?php } ?>

		    			<?php } ?>
		    			
		    			<?php if($page_nav>20&&$page+10<$original_page-2){ ?>
		    			<?php $page_nav=$original_page>0?$original_page:1; ?>
		    					<li class="page-navigation disabled"><a href="#">. . .</a></li>
		    					<li class="page-navigation <?php page_indicator($original_page-1,$page); ?>" id="?id=<?php echo $id; ?>&page<?php echo $original_page-1; ?>"><a href="?id=<?php echo $id; ?>&page=<?php echo $original_page-1;  ?>"><?php echo $original_page-1;  ?></a></li>
		    					<li class="page-navigation <?php page_indicator($original_page,$page); ?>" id="?id=<?php echo $id; ?>&page<?php echo $original_page; ?>"><a href="?id=<?php echo $id; ?>&page=<?php echo $original_page;  ?>"><?php echo $original_page;  ?></a></li>
		    			<?php } ?>
						
								
					
						 <li>


		  				<a href="?id=<?php echo $id; ?>&page=<?php echo $items['pages']; ?>" aria-label="Next">
		   					<span aria-hidden="true">»</span>
		 				 </a>
					</li>
					 </ul>

			</nav>
						
		</div>

<?php } ?>


		<?php }else{ ?>
			<p><br/><br/><br/><br/><center><img src="<?php echo base_url(); ?>assets/images/SEARCA.png" width="40%"/></center></p><br/>
			<p>A document management system (DMS) is a system (based on computer programs in the case of the management of digital documents) used to track, manage and store documents and reduce paper. Most are capable of keeping a record of the various versions created and modified by different users (history tracking).</p>
			<p>Document management, often referred to as Document Management Systems (DMS), is the use of a computer system and software to store, manage and track electronic documents and electronic images of paper based information captured through the use of a document scanner. 

Document management is how your organization stores, manages and tracks its electronic documents.

According to ISO 12651-2, a document is "recorded information or object which can be treated as a unit". While this sounds a little complicated, it is quite simply what you have been using to create, distribute and use for years.

Now, we can define document management as the software that controls and organizes documents throughout an organization. It incorporates document and content capture, workflow, document repositories, COLD/ERM, and output systems, and information retrieval systems.  Also, the processes used to track, store and control documents.</p>

		<?php } ?>
		<div class="col col-md-12">
			<?php include_once('copyright.php'); ?>
		</div>
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