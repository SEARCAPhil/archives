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

						<h3 class="text-muted"><i class="material-icons md-36">find_in_page</i> Advanced Search</h3>	
						<p>Advanced search is a full search of the entire dictionary text. It finds your term wherever it occurs in the dictionary. This could be in the form of an entry name, part of another word's definition, in a quotation, etc. An Advanced search also allows you to search for words that occur near one another, such as bread before butter.</p>
					</div>
				</article>
			</div>
			<div class="row">

				<article  class="col col-md-12 col-lg-6"><br/>
					<div class="col col-lg-12 text-muted text-justify">	
					
					</div>
				</article>
			</div>
				
				<?php echo form_open('advance/search/result/','class="form-horizontal" method="GET"');  ?>
		

			<!--first-->
			<article class="col col-md-12 col-lg-6">
				<div class="col col-lg-12"  style="background: #fff;border-radius: 10px;box-shadow: 0px 0px 3px rgba(200,200,200,0.7);padding: 20px 20px;margin-top: 50px;">

				<h5 class="page-header text-muted"><b><i class="material-icons">laptop</i> Basic Information</b></h5>
				<p class="text-danger"><small>*Please use  <b>|</b> sign for multi-valued fields. Ex. Title: <u>development support | agriculture</u>  </small></p><hr/><br/>
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Document Tile</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Title" name="document_title" value="<?php echo $this->input->get('document_title'); ?>">
								
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Source Title</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Source Title" name="source_title" value="<?php echo $this->input->get('source_title'); ?>">
								

							</div>
						</div>




						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Creator</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="creator" name="creator" value="<?php echo $this->input->get('creator'); ?>">

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Publisher</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Publisher" name="publisher" value="<?php echo $this->input->get('publisher'); ?>">
							</div>
						</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputContent" class="control-label col-xs-3 ">Content Description</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="Content Description" name="content_description" rows="10">
									<?php echo trim($this->input->get('content_description')); ?>
								</textarea> 
								

							</div>
						</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Place</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="place" name="place" value="<?php echo $this->input->get('place'); ?>">
							</div>
						</div>

						
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Date</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Date" name="date_of_input" value="<?php echo $this->input->get('date_of_input'); ?>">
								

							</div>
						</div>


					
						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Collation</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Collation" name="collation" value="<?php echo $this->input->get('collation'); ?>">
							
							</div>
						</div>


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Language</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Language" name="language" value="<?php echo $this->input->get('language'); ?>">
								
							</div>
						</div>

						

				
				<!--/first-->

				<!--second-->
				
						<br/><h5 class="page-header text-muted"><b><i class="material-icons">cloud</i> Location</b></h5><br/>	
							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Location</label>
								<div class="col-xs-9">
									<input type="text" class="form-control" id="inputTitle" placeholder="Location" name="location" value="<?php echo $this->input->get('location'); ?>">

								</div>
							</div>


							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Shelf Cabinet Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Shelf Cabinet Number" name="shelf_cabinet_number" value="<?php echo $this->input->get('shelf_cabinet_number'); ?>">
									<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
									<span id="titleAlert" class="text-danger alert-data"></span>
									

								</div>
							</div>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Tier Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Shelf Cabinet Number" name="tier_number" value="<?php echo $this->input->get('tier_number'); ?>">
								
								</div>
							</div>


							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Box Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Box Number" name="box_number" value="<?php echo $this->input->get('box_number'); ?>">
									

								</div>
							</div>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Folder Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Folder Number" name="folder_number" value="<?php echo $this->input->get('folder_number'); ?>">

								</div>
							</div>

							<div class="form-group has-feedback" id="form-title">
								<label for="inputTitle" class="control-label col-xs-3 ">Record/Code  Number</label>
								<div class="col-xs-9">
									<input type="text" min="1" class="form-control" id="inputTitle" placeholder="Record/Code  Number" name="record_number" value="<?php echo $this->input->get('record_number'); ?>">
									

								</div>
							</div>


							<div class="form-group has-feedback" id="form-title">
						

								<label for="inputTitle" class="control-label col-xs-3 ">Date Range</label>
								<div class="col-xs-9">
									<input type="text" class="form-control" id="inputTitle" placeholder="Date Range" name="date_range" value="<?php echo $this->input->get('date_range'); ?>" >
									

								</div>
							</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Quantity</label>
							<div class="col-xs-9">
								<input type="number" min="1" class="form-control" id="inputTitle" placeholder="Quantity" name="quantity" value="<?php echo $this->input->get('quantity'); ?>">
							</div>
						</div>

						



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
								<input type="text" class="form-control" id="inputTitle" placeholder="Access Condition" name="access_condition" value="<?php echo $this->input->get('access_condition'); ?>">
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Physical Condition</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Physical Condition" name="physical_condition" value="<?php echo $this->input->get('physical_condition'); ?>"

							</div>
						</div>



						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Record Group</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="record group" name="record_group" value="<?php echo $this->input->get('record_group'); ?>">
								

							</div>
						</div>

						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Material</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="material" name="material" value="<?php echo $this->input->get('material'); ?>" >
								

							</div>
						</div>


						
					<!--/third-->

					


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Notes</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="Notes" name="notes" rows="10">
									<?php echo $this->input->get('notes'); ?>
								</textarea> 
								<!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
								<span id="titleAlert" class="text-danger alert-data"></span>
								

							</div>
						</div>


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Keywords</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="keywords" name="keywords">
									<?php echo $this->input->get('keywords'); ?>
								</textarea> 
								

							</div>
						</div>


						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Provenance</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTitle" placeholder="Provenance" name="provenance" value="<?php echo $this->input->get('provenance'); ?>">
								

							</div>
						</div>




						<div class="form-group has-feedback" id="form-title">
							<label for="inputTitle" class="control-label col-xs-3 ">Remarks</label>
							<div class="col-xs-9">
								<textarea class="form-control" placeholder="remarks" name="remarks">
									<?php echo $this->input->get('remarks'); ?>
								</textarea> 
								

							</div>
						</div>


						
						<!--title-->
						<h5 class="page-header text-muted"><b><i class="material-icons">filter_list</i> Logic Operator</b></h5><br/>


						
						<div class="col col-md-12">
							<p><input type="radio" name="logic" value="and" <?php echo $this->input->get('logic')=='and'?'checked="checked"':''; ?> /> AND </p>
							<p><input type="radio" name="logic" value="or" <?php echo $this->input->get('logic')=='or'?'checked="checked"':''; ?>/> OR </p>
							<p><input type="radio" name="logic" value="not" <?php echo $this->input->get('logic')=='not'?'checked="checked"':''; ?>/> NOT </p>
						</div>



						<!--submit-->
						<div class="col col-md-12">
							<label for="inputDescription" class="control-label col-xs-3 sr-only">submit</label>
							<div class="col-xs-9"> 
								<input type="submit" class="btn btn-success btn-block  continue" aria-hidden="true" value="Search" id="next">
								
							</div>
						</div>

				

					</div>
					</article>



		
	</form>



	</div>

</div>