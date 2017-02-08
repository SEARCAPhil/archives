
<div class="container">
	<?php if(count($data)>0): ?>
	<div class=" table-responsive col col-md-2 ">
		<div class="row">
			<img src="<?php echo base_url(); ?>assets/images/logo-new.png" width="100%"/>
		</div><br/>
		<div class="list-group row">
			<?php for($x=0;$x<count($data);$x++){ ?>
				<a href="<?php echo base_url(); ?>?id=<?php echo $data[$x]->id; ?>&parent=<?php echo @$param['id']; ?>" class="list-group-item"><?php echo $data[$x]->category; ?> <small class="text-muted">(<?php echo $data[$x]->code; ?>)</small></a>
			<?php } ?>
		</div>
		
	</div>
	<?php endif; ?>

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
				<li><b>Category :</b><u><?php echo $items[0]->category; ?></u></li>
				<li><b>Date Range :</b>    <?php echo $items[0]->date_range; ?></li>
				<li><b>Language :</b>    <?php echo $items[0]->language; ?></li>	
				<li><b>Shelf Cabinet Number :</b>    <?php echo $items[0]->shelf_cabinet_number; ?></li>	
				<li><b>Box Number :</b>    <?php echo $items[0]->box_number; ?></li>						
				<li><b>Folder Number :</b>    <?php echo $items[0]->folder_number; ?></li>						
				<li><b>Record Number :</b>    <?php echo $items[0]->record_number; ?></li>																					
				<li><b>Creator :</b>    <?php echo $items[0]->creator; ?></li>				
				<li><b>Collation :</b>    <?php echo $items[0]->collation; ?></li>
				<li ><b>Provenance :</b>   <?php echo $items[0]->provenance; ?></li>
				<li><b>Encoded By :</b>    <?php echo $items[0]->encoded_by; ?></li>
				<li ><b>Date of Input :</b>    <?php echo $items[0]->date_of_input; ?></li>		
				<li><b>Keywords :</b> <?php echo $items[0]->keywords; ?></li>				 
						
				</ul>
		</div>


	
		

	</div>
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