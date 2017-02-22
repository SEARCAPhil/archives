
<div class="container">

<?php if(isset($items[0])){ ?>
	<div class=" table-responsive col col-md-10 col-md-offset-1 ">
		
		<p>
			<li class="dropdown list-unstyled pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
			<ul class="dropdown dropdown-menu">
				
					<li class="" >
						<a href="<?php echo base_url(); ?>form/?id=<?php echo $items[0]->id; ?>" class="modifier" data-menu="update" data-cat="<?php echo $items[0]->id; ?>">Update</a>
					</li>
					<li class="" data-toggle="modal" data-target="#myModal">
						<a href="#" class="modifier" id="file" data-menu="update" data-cat="<?php echo $items[0]->id; ?>" data-parent="<?php echo @$items[0]->cat_id; ?>">Attach File</a>
					</li>
					<li class="" data-toggle="modal" data-target="#myModal">
						<a href="#" class="modifier" data-menu="remove" data-toggle="modal" data-cat="<?php echo $items[0]->id; ?>">Remove</a>
					</li>
					
				
			</ul>
		</li>

		</p>

		<h3><span class="glyphicon glyphicon-bookmark"></span> <?php echo $items[0]->document_title; ?></h3>
		<p class="text-muted"><?php echo ucfirst(utf8_encode($items[0]->content_description)); ?></p>
		<p>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> 
				<?php echo $items[0]->original_file_name; ?>
					<span class="btn btn-xs btn-success download" data-cat="<?php echo $items[0]->id; ?>">
						<span class="glyphicon glyphicon-download"></span> Download 
					</span>
			</small>
		</p>

		
		<br/>
		
		
		




		<br/>
		<div>
			<ul class="list-unstyled list-details">
				<?php function is_empty($text){

					$value=(string) $text;
					$value=trim($value);

					if(!empty($value)) return 0;
					return 1;

				} ?>
				<!--
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Category :</b><u><?php echo $items[0]->category; ?></u></li> <?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Date Range :</b>    <?php echo $items[0]->date_range; ?></li> <?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Language :</b>    <?php echo $items[0]->language; ?></li> <?php } ?>	
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Shelf Cabinet Number :</b>    <?php echo $items[0]->shelf_cabinet_number; ?></li> <?php } ?>	
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Box Number :</b>    <?php echo $items[0]->box_number; ?></li> <?php } ?>						
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Folder Number :</b>    <?php echo $items[0]->folder_number; ?></li>	<?php } ?>					
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Record Number :</b>    <?php echo $items[0]->record_number; ?></li>	<?php } ?>					
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Creator :</b>    <?php echo $items[0]->creator; ?></li>	<?php } ?>			
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Collation :</b>    <?php echo $items[0]->collation; ?></li><?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li ><b>Provenance :</b>   <?php echo $items[0]->provenance; ?></li><?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Encoded By :</b>    <?php echo $items[0]->encoded_by; ?></li><?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li ><b>Date of Input :</b>    <?php echo $items[0]->date_of_input; ?></li><?php } ?>		
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Keywords :</b> <?php echo $items[0]->keywords; ?></li><?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li><b>Source Title :</b> <?php echo $items[0]->source_title; ?></li><?php } ?>
				-->		

				<?php if(!is_empty($items[0]->document_title)){ ?> <li><span class="col col-md-3 row"><b>Document Title :</b></span> <span class="col col-md-9"><?php echo nl2br($items[0]->document_title); ?></span></li><?php } ?>
				<?php if(!is_empty($items[0]->category)){ ?> <li><span class="col col-md-3 row"><b>Category :</b></span> <span class="col col-md-9"><?php echo nl2br($items[0]->category); ?></span></li><?php } ?>
				<?php if(!is_empty($items[0]->source_title)){ ?> <li><span class="col col-md-3 row"><b>Source Title :</b></span> <span class="col col-md-9"><?php echo nl2br($items[0]->source_title); ?></span></li><?php } ?>
				<?php if(!is_empty($items[0]->creator)){ ?> <li><span class="col col-md-3 row"><b>Creator :</b></span> <span class="col col-md-9"><?php echo nl2br($items[0]->creator); ?></span></li><?php } ?>
				<?php if(!is_empty($items[0]->publisher)){ ?> <li><span class="col col-md-3 row"><b>Publisher :</b></span> <span class="col col-md-9"><?php echo nl2br($items[0]->publisher); ?></span></li><?php } ?>
				<?php if(!is_empty($items[0]->content_description)){ ?> <li>
					<span class="col col-md-3 row"><b>Content Description :</b></span>
				 	<span class="col col-md-9"><?php echo nl2br($items[0]->content_description); ?></span></li>
				<?php } ?>	
				<?php if(!is_empty($items[0]->place)){ ?> <li><span class="col col-md-3 row"><b>Place :</b></span> <span class="col col-md-9"><?php echo $items[0]->place; ?></span></li><?php } ?>


				<?php if(!is_empty($items[0]->date_of_input)){ ?> 
					<li><span class="col col-md-3 row"><b>Date :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->date_of_input; ?></span>
				</li><?php } ?>


				<?php if(!is_empty($items[0]->collation)){ ?> 
					<li><span class="col col-md-3 row"><b>Collation :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->collation; ?></span>
				</li><?php } ?>


				<?php if(!is_empty($items[0]->language)){ ?> 
					<li><span class="col col-md-3 row"><b>Language :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->language; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->access_condition)){ ?> 
					<li><span class="col col-md-3 row"><b>Access Condition :</b></span> 
						<span class="col col-md-9"><?php echo $items[0]->access_condition; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->physical_condition)){ ?> 
					<li>
						<span class="col col-md-3 row"><b>Physical Condition :</b></span> 
						<span class="col col-md-9"><?php echo $items[0]->physical_condition; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->record_number)){ ?>
					 <li>
					 	<span class="col col-md-3 row"><b>Record Group :</b></span> 
					 	<span class="col col-md-9"><?php echo $items[0]->record_number; ?></span>
					 </li>
				 <?php } ?>

				<?php if(!is_empty($items[0]->material)){ ?> 
					<li>
						<span class="col col-md-3 row"><b>Material :</b></span> 
						<span class="col col-md-9"><?php echo $items[0]->material; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->notes)){ ?>
				 	<li><span class="col col-md-3 row"><b>Notes :</b></span> 
				 		<span class="col col-md-9"><?php echo nl2br($items[0]->notes); ?></span>
				 	</li>
				 <?php } ?>


				<?php if(!is_empty($items[0]->keywords)){ ?> 
					<li><span class="col col-md-3 row"><b>Keywords :</b></span> 
						<span class="col col-md-9"><?php echo $items[0]->keywords; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->provenance)){ ?> 
					<li><span class="col col-md-3 row"><b>Provenance :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->provenance; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->remarks)){ ?> 
					<li><span class="col col-md-3 row"><b>Remarks :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->remarks; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->location)){ ?> 
					<li><span class="col col-md-3 row"><b>Location :</b></span> 
						<span class="col col-md-9"><?php echo $items[0]->location; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->shelf_cabinet_number)){ ?> 
					<li><span class="col col-md-3 row"><b>Shelf Cabinet Number :</b> </span>
						<span class="col col-md-9"><?php echo $items[0]->shelf_cabinet_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->tier_number)){ ?> 
					<li><span class="col col-md-3 row"><b>Tier Number :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->tier_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->box_number)){ ?> 
					<li><span class="col col-md-3 row"><b>Box Number :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->box_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->folder_number)){ ?> 
					<li><span class="col col-md-3 row"><b>Folder Number :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->folder_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->id)){ ?> 
					<li><span class="col col-md-3 row"><b>Record/Code Number :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->id; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->date_range)){ ?> 
					<li><span class="col col-md-3 row"><b>Date Range :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->date_range; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->quantity)){ ?> 
					<li><span class="col col-md-3 row"><b>Quantity :</b></span> 
					<span class="col col-md-9"><?php echo $items[0]->quantity; ?></span>
					</li>
				<?php } ?>	

						
				</ul>
		</div>

	</div>

	<?php }else{ ?>
		<center class="text-muted"><h1>Content Unavailable</h1></center>
	<?php } ?>
</div>
<div class="col col-md-12">
			<?php include_once('copyright.php'); ?>
		</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">
     
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo site_url().'assets/javascripts/modifier.js'; ?>"></script>