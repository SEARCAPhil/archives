<style type="text/css">
	body{
		background: rgba(250,250,250,0.8);
	}
</style>
<div class="col col-md-9 col-sm-9 col-lg-10">

	

	<div class="col col-xs-12">

			<div class="col row">			<!--first-->
				<article class="col col-md-12 col-lg-6">
					<div class="col col-lg-12"  style="background: #fff;border-radius: 10px;box-shadow: 0px 0px 3px rgba(200,200,200,0.7);padding: 20px 20px;margin-top: 50px;">

						<h3 class="text-muted"><i class="material-icons md-36">find_in_page</i> Advance Search</h3>	
					</div>
				</article>
			</div>
			<div class="row">

				<article  class="col col-md-12 col-lg-6"><br/>
					<div class="col col-lg-12 text-muted text-justify">	
						<p>Advanced search is a full search of the entire dictionary text. It finds your term wherever it occurs in the dictionary. This could be in the form of an entry name, part of another word's definition, in a quotation, etc. An Advanced search also allows you to search for words that occur near one another, such as bread before butter.</p>
					</div>
				</article>
			</div>
				<?php echo form_open('advance/search/','class="form-horizontal",action='.$_SERVER['PHP_SELF']);  ?>
		

			<!--first-->
			<article class="col col-md-12 col-lg-6">
				<div class="col col-lg-12"  style="background: #fff;border-radius: 10px;box-shadow: 0px 0px 3px rgba(200,200,200,0.7);padding: 20px 20px;margin-top: 50px;">

				<h5 class="page-header text-muted"><b><i class="material-icons">laptop</i> Basic Information</b></h5><br/>
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Document Tile</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title" value="<?php echo strlen(set_value('title'))>0?set_value('title'):@$items[0]->document_title; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data">
									<?php echo form_error('title'); ?>
								</span>
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Source Title</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Source Title" name="source" value="<?php echo strlen(set_value('source'))>0?set_value('source'):@$items[0]->source_title; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data">
									<?php echo form_error('source'); ?>
								</span>
								

							</div>
						</div>




						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Creator</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="creator" name="creator" value="<?php echo strlen(set_value('creator'))>0?set_value('creator'):@$items[0]->creator; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data">
									<?php echo form_error('creator'); ?>
								</span>
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Publisher</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Publisher" name="publisher" value="<?php echo strlen(set_value('publisher'))>0?set_value('publisher'):@$items[0]->publisher; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data">
									<?php echo form_error('publisher'); ?>
								</span>
								

							</div>
						</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Content Description</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="Content Description" name="content_description" rows="10">
									<?php echo strlen(set_value('content_description'))>0?set_value('content_description'):@$items[0]->content_description; ?>
								</textarea> 
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"><?php echo form_error('content_description'); ?></span>
								

							</div>
						</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Place</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="place" name="place" value="<?php echo strlen(set_value('place'))>0?set_value('place'):@$items[0]->place; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>

						
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Date</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Date" name="date" value="<?php echo strlen(set_value('date'))>0?set_value('date'):@$items[0]->date; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


					
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Collation</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Collation" name="collation" value="<?php echo strlen(set_value('collation'))>0?set_value('collation'):@$items[0]->collation; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Language</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Language" name="lang" value="<?php echo strlen(set_value('language'))>0?set_value('language'):@$items[0]->language; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>

						

				
				<!--/first-->

				<!--second-->
				
						<br/><h5 class="page-header text-muted"><b><i class="material-icons">cloud</i> Location</b></h5><br/>	
							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Location</label>
								<div class="col-xs-9">
									<input type="text" class="form-control" id="inputTitle" placeholder="Location" name="loc" value="<?php echo strlen(set_value('loc'))>0?set_value('loc'):@$items[0]->location; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>


							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Shelf Cabinet Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Shelf Cabinet Number" name="shelf" value="<?php echo strlen(set_value('shelf'))>0?set_value('shelf'):@$items[0]->shelf_cabinet_number; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Tier Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Shelf Cabinet Number" name="tier" value="<?php echo strlen(set_value('tier'))>0?set_value('tier'):@$items[0]->tier_number; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>


							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Box Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Box Number" name="box" value="<?php echo strlen(set_value('box'))>0?set_value('box'):@$items[0]->box_number; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Folder Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Folder Number" name="folder" value="<?php echo strlen(set_value('folder'))>0?set_value('folder_number'):@$items[0]->folder_number; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Record/Code  Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Record/Code  Number" name="record" value="<?php echo strlen(set_value('record'))>0?set_value('record'):@$items[0]->record_number; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>


							<div class="form-group has-feedback" id="form-title">
								<input type="hidden" value="69" name="cat" id="catId">
								<input type="hidden" name="sub" id="subId">
								<label for="inputTitle" class="control-label col-xs-3 ">Date Range</label>
								<div class="col-xs-9">
									<input type="text" class="form-control" id="inputTitle" placeholder="Date Range" name="date_range" value="<?php echo strlen(set_value('date_range'))>0?set_value('date_range'):@$items[0]->date_range; ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Quantity</label>
							<div class="col-xs-9">
								<input type="number" min="1" class="form-control" id="inputTitle" placeholder="Quantity" name="quantity" value="<?php echo strlen(set_value('quantity'))>0?set_value('quantity'):@$items[0]->quantity; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>

						<?php if(isset($_GET['item_id'])): ?>
							<input type="hidden" value="<?php echo @$items[0]->id; ?>" name="id">
							<!--<input type="hidden" value="<?php echo @$items[0]->cat_id; ?>" name="series">-->
						<?php endif; ?>

						<?php if(!isset($_GET['item_id'])): ?>
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Series</label>
							<div class="col-xs-9"> 
								<select name="series" class="form-control series main-series" id="series">
										<option value="0">Select category</option>
								<?php for($x=0;$x<count($data);$x++): ?>
										<option value="<?php echo $data[$x]->id; ?>"><?php echo $data[$x]->category; ?></option>
								<?php endfor; ?>		
								</select>
								<!---->
								<div class="series-result">
									
								</div>
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data">
									<?php echo form_error('series'); ?>
								</span>
								

							</div>
						</div>
						<?php endif; ?>

						
						<?php if(isset($items[0]->category)): ?>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Series</label>
								<div class="col-xs-9">
									<p style="padding-top: 5px;"><b>Current: <?php echo $items[0]->category; ?></b></p>
									<select name="series" class="form-control series main-series" id="series">
											<option value="<?php echo @$items[0]->cat_id; ?>">Select category</option>
									<?php for($x=0;$x<count($data);$x++): ?>
											<option value="<?php echo $data[$x]->id; ?>"><?php echo $data[$x]->category; ?></option>
									<?php endfor; ?>		
									</select>
									<!---->
									<div class="series-result">
										
									</div>
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data">
										<?php echo form_error('series'); ?>
									</span>
									

								</div>
							</div>
						<?php endif; ?>

						</div>

					</article>
					<!--/second-->
					<!--third-->
					<article class="col col-md-12 col-lg-6">
						<div class="col col-lg-12"  style="background: #fff;border-radius: 10px;box-shadow: 0px 0px 3px rgba(200,200,200,0.7);padding: 20px 20px;margin-top: 50px;">	
						<!--title-->
						<h5 class="page-header text-muted"><b><i class="material-icons">insert_drive_file</i> Condition</b></h5><br/>


						
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Access Condition</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Access Condition" name="access" value="<?php echo strlen(set_value('access_condition'))>0?set_value('access_condition'):@$items[0]->access_condition; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Physical Condition</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Physical Condition" name="physical" value="<?php echo strlen(set_value('physical_condition'))>0?set_value('physical_condition'):@$items[0]->physical_condition; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Record Group</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="record group" name="record_group" value="<?php echo strlen(set_value('record_group'))>0?set_value('record_group'):@$items[0]->record_group; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Material</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="material" name="printable" value="<?php echo strlen(set_value('material'))>0?set_value('material'):@$items[0]->material; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="printableAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


						
					<!--/third-->

					


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Notes</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="Notes" name="notes" rows="10">
									<?php echo strlen(set_value('notes'))>0?set_value('notes'):@$items[0]->notes; ?>
								</textarea> 
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Keywords</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="keywords" name="keywords">
									<?php echo strlen(set_value('keywords'))>0?set_value('keywords'):@$items[0]->keywords; ?>
								</textarea> 
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Provenance</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Provenance" name="provenance" value="<?php echo strlen(set_value('provenance'))>0?set_value('provenance'):@$items[0]->provenance; ?>">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>




						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Remarks</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="remarks" name="remarks">
									<?php echo strlen(set_value('remarks'))>0?set_value('remarks'):@$items[0]->remarks; ?>
								</textarea> 
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


						<!--<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">File</label>
							<div class="col-xs-9">
								<input type="file" class="" id="inputTitle" placeholder="Content Description" name="file">
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<!--<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>-->





						<!--submit-->
						<div class="form-group has-feedback">
							<label for="inputDescription" class="control-label col-xs-3 sr-only">submit</label>
							<div class="col-xs-9"> 
								<input type="submit" class="btn btn-success btn-block sr-only continue" aria-hidden="true" value="Done" id="next">
								
							</div>
						</div>

				
						
						<!--title-->
						<h5 class="page-header text-muted"><b><i class="material-icons">filter_list</i> Expression</b></h5><br/>


						
						<div class="col col-md-12">
							<p><input type="radio" name="expression" /> AND </p>
							<p><input type="radio" name="expression" /> OR </p>
							<p><input type="radio" name="expression" /> NOT </p>
						</div>



					</div>
					</article>



		
	</form>



	</div>

</div>