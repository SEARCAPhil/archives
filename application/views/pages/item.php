<?php include_once('panel_subcategory.php'); ?>
<div class="col col-md-6 col-sm-9 col-lg-8 item-status"></div>

<div class="col col-md-6 col-sm-9 col-lg-8 item<?php echo @($items[0]->id) ?>">
		<div class="col col-md-12">
			<h3><?php echo ucfirst($items[0]->document_title); ?></h3>
			<!--download button-->
			<?php if(!empty(@$items[0]->original_file_name)){ ?>
			<p>
				<small>
						
						<span class="btn btn-xs btn-success download" data-cat="<?php echo $items[0]->id; ?>">
							<i class="material-icons pull-left">cloud_download</i> <span class="pull-left" style="padding: 5px 0 0 5px;">Download</span>
						</span>
						<span class="text-muted"><?php echo $items[0]->original_file_name; ?></span>
				</small>
			</p>

			<?php } ?>

			
			<br/>
		


		</div>
</div>

<div class="col col-lg-8 col-sm-9 col-md-6 col-xs-12 pull-right document-header item<?php echo @($items[0]->id) ?>">
	<div class="text-center	 col col-lg-3 col-md-4 col-sm-4 col-xs-4" style="border-right: 1px solid rgb(240,240,240);padding-top: 20px;">
		<p class="text-danger"><b><?php echo ($items[0]->record_number); ?></b></p>
		<p><small>Record Number</small></p>

	</div>

	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 text-center" onclick="window.open('report/item/?item_id=<?php echo @$items[0]->id; ?>'+($(this).attr('data-custom').length>0?'&custom='+$(this).attr('data-custom'):''));" data-custom='' id="print_button"  style="border-right: 1px solid rgb(240,240,240);">
		<h3><b> <i class="material-icons md-36">print</i></b> </h3>

	</div>


	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 text-center custom-print">
		<h3><b> <i class="material-icons md-36">print</i>  <i class="material-icons md-36">description</i></b> </h3>

	</div>

	
</div>
<div  class="col col-md-6 col-sm-9 col-lg-8 item<?php echo @($items[0]->id) ?>">

<?php if(isset($items[0])){ ?>
	<div class="col col-md-12 col-sm-12 col-lg-12 ">
		
		<p>
			<li class="dropdown list-unstyled pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons pull-right">keyboard_arrow_down</i></a>
			<ul class="dropdown dropdown-menu">
				
					<li class="" >
						<a href="<?php echo base_url(); ?>form/?item_id=<?php echo $items[0]->id; ?>&id=<?php echo strip_tags(htmlentities($_GET['id'])); ?>&redirect_url=<?php echo str_replace('&','||',$_SERVER['REQUEST_URI']); ?>" class="modifier" data-menu="update" data-cat="<?php echo $items[0]->id; ?>">Update</a>
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

		<!--<h3><span class="glyphicon glyphicon-bookmark"></span> <?php echo $items[0]->document_title; ?></h3>
		<p class="text-muted"><?php echo ucfirst(utf8_encode($items[0]->content_description)); ?></p>-->

		
		




		<br/>
		<div class="row col col-xs-12">
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

				<?php if(!is_empty($items[0]->document_title)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="documentTitleCheckBox" name="document_title" class="checkbox-group"> 

						            <label for="documentTitleCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Document Title :</b>
						</span> 
						<span class="col col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->document_title); ?></span>
					</li>
				<?php } ?>



				<?php if(!is_empty($items[0]->category)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="categoryCheckBox" name="category" class="checkbox-group"> 

						            <label for="categoryCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Category :</b></span> 
						<span class=" col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->category); ?></span>
				</li><?php } ?>


				<?php if(!is_empty($items[0]->source_title)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
						<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="sourceTitleCheckBox" name="source_title" class="checkbox-group"> 

						            <label for="sourceTitleCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Source Title :</b></span> 
						<span class=" col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->source_title); ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->creator)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="creatorCheckBox" name="creator" class="checkbox-group"> 

						            <label for="creatorCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Creator :</b>
						</span> 
						<span class=" col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->creator); ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->publisher)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="publisherCheckBox" name="publisher" class="checkbox-group"> 

						            <label for="publisherCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Publisher :</b>
						</span> 
						<span class=" col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->publisher); ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->content_description)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="contentDescriptionCheckBox" name="content_description" class="checkbox-group"> 

						            <label for="contentDescriptionCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Content Description :</b>
						</span>
				 		<span class="col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->content_description); ?></span>
				 	</li>
				<?php } ?>	


				<?php if(!is_empty($items[0]->keywords)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="keywordsXXCheckBox" name="keywords" class="checkbox-group"> 

						            <label for="keywordsXXCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Keywords :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->keywords); ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->place)){ ?> 
						<li class="row">
							<span class="col col-md-3 col-sm-4 col-xs-12">
								<span  class="custom-print-checkbox">
									 <span>
							            <input type="checkbox" id="placeCheckBox" name="place" class="checkbox-group"> 

							            <label for="placeCheckBox"><span></span></label>
							          </span> 
								</span>
								<b>Place :</b>
							</span> 
							<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->place; ?></span>
						</li>
					<?php } ?>


				<?php if(!is_empty($items[0]->date_of_input)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="dateOfInputCheckBox" name="date_of_input" class="checkbox-group"> 

						            <label for="dateOfInputCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Date :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->date_of_input; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->collation)){ ?> 
						<li class="row">
							<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
								<span  class="custom-print-checkbox">
									 <span>
							            <input type="checkbox" id="collationCheckBox" name="collation" class="checkbox-group"> 

							            <label for="collationCheckBox"><span></span></label>
							          </span> 
								</span>
								<b>Collation :</b>
							</span> 
							<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->collation; ?></span>
						</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->language)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="languageCheckBox" name="language" class="checkbox-group"> 

						            <label for="languageCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Language :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->language; ?></span>
					</li>
				<?php } ?>



				<?php if(!is_empty($items[0]->access_condition)){ ?> 
					<li>
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="accessConditionCheckBox" name="access_condition" class="checkbox-group"> 

						            <label for="accessConditionCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Access Condition :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->access_condition; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->physical_condition)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="physicalConditionCheckBox" name="physical_condition" class="checkbox-group"> 

						            <label for="physicalConditionCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Physical Condition :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->physical_condition; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->record_number)){ ?>
					 <li class="row">
					 	<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
					 		<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="recordNumberXXCheckBox" name="record_number" class="checkbox-group"> 

						            <label for="recordNumberXXCheckBox"><span></span></label>
						          </span> 
							</span>
					 		<b>Record Group :</b>
					 	</span> 
					 	<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->record_group; ?></span>
					 </li>
				 <?php } ?>

				<?php if(!is_empty($items[0]->material)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="materialCheckBox" name="material" class="checkbox-group"> 

						            <label for="materialCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Material :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->material; ?></span>
					</li>
				<?php } ?>


				<?php if(!is_empty($items[0]->notes)){ ?>
				 	<li class="row">
				 		<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
				 			<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="notesCheckBox" name="notes" class="checkbox-group"> 

						            <label for="notesCheckBox"><span></span></label>
						          </span> 
							</span>
				 			<b>Notes :</b></span> 
				 		<span class="col-md-9 col-sm-8 col-xs-12"><?php echo nl2br($items[0]->notes); ?></span>
				 	</li>
				 <?php } ?>


				<?php if(!is_empty($items[0]->provenance)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="provenanceCheckBox" name="provenance" class="checkbox-group"> 

						            <label for="provenanceCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Provenance :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->provenance; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->remarks)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
								<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="remarksCheckBox" name="remarks" class="checkbox-group"> 

						            <label for="remarksCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Remarks :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->remarks; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->location)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="locationCheckBox" name="location" class="checkbox-group"> 

						            <label for="locationCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Location :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->location; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->shelf_cabinet_number)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="shelfCabinetNumberCheckBox" name="shelf_cabinet_number" class="checkbox-group"> 

						            <label for="shelfCabinetNumberCheckBox"><span></span></label>
						          </span> 
							</span>
								<b>Shelf Cabinet Number :</b>
						</span>
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->shelf_cabinet_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->tier_number)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">

							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="tierNumberCheckBox" name="tier_number" class="checkbox-group"> 

						            <label for="tierNumberCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Tier Number :</b>

						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->tier_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->box_number)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="boxNumberCheckBox" name="box_number" class="checkbox-group"> 

						            <label for="boxNumberCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Box Number :</b>
						</span> 
					<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->box_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->folder_number)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="folderNumberCheckBox" name="folder_number" class="checkbox-group"> 

						            <label for="folderNumberCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Folder Number :</b>
						</span> 
					<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->folder_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->id)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="idXXCheckBox" name="id" class="checkbox-group"> 

						            <label for="idXXCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Record/Code Number :</b>
						</span> 
					<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->record_number; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->date_range)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="dateRangeCheckBox" name="date_range" class="checkbox-group"> 

						            <label for="dateRangeCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Date Range :</b>
						</span> 
					<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->date_range; ?></span>
					</li>
				<?php } ?>

				<?php if(!is_empty($items[0]->quantity)){ ?> 
					<li class="row">
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
							<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="quantityCheckBox" name="quantity" class="checkbox-group"> 

						            <label for="quantityCheckBox"><span></span></label>
						          </span> 
							</span>
							<b>Quantity :</b>
						</span> 
						<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->quantity; ?></span>
					</li>
				<?php } ?>	

				<?php if(!is_empty($items[0]->profile_name)&&!is_null($items[0]->profile_name)){ ?> 
					<li class="row">
						<span  class="custom-print-checkbox">
								 <span>
						            <input type="checkbox" id="encodedByCheckBox" name="encoded_by" class="checkbox-group"> 

						            <label for="encodedByCheckBox"><span></span></label>
						          </span> 
							</span>
						<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12"><b>Encoded By :</b>
					</span> 
					<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->profile_name; ?></span>
					</li>
				<?php }else{?>
					<?php if(!empty($items[0]->encoded_by))	{ ?>
						<li class="row">
							<span class="col col-md-12 col-lg-3 col-sm-4 col-xs-12">
								<span  class="custom-print-checkbox">
									 <span>
							            <input type="checkbox" id="encodedByCheckBox" name="encoded_by" class="checkbox-group"> 

							            <label for="encodedByCheckBox"><span></span></label>
							          </span> 
								</span>
								<b>Encoded By :</b>
							</span> 
							<span class="col-md-9 col-sm-8 col-xs-12"><?php echo $items[0]->encoded_by; ?></span>
						</li>
					<?php } ?>
				<?php } ?>	



						
				</ul>
		</div>

	</div>

	<?php }else{ ?>
		<center class="text-muted"><h1>Content Unavailable</h1></center>
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