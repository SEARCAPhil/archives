		<div class="col col-lg-2 col-md-3 col-sm-3 hidden-xs left-navigation-section">
			<div class="left-navigation">
				<div class="row">
					<span class="left-navigation-header"   data-toggle="collapse" data-target=".account-section"><i class="material-icons">account_circle</i> Account <i class="material-icons pull-right" onclick="$(this).html()=='keyboard_arrow_right'?$(this).html('keyboard_arrow_down'):$(this).html('keyboard_arrow_right')">keyboard_arrow_right</i></span>
				</div>


				<ul class="list-unstyled collapse account-section" style="height: 100%;">
				
						<li class="text-muted">
							<a href="#">&emsp;<b><?php echo($_SESSION['name']); ?></b></a>
						</li>
						
					
				</ul>
				
				<div class="row">
					<span class="left-navigation-header"   data-toggle="collapse" data-target=".advance-settings-section"><i class="material-icons">settings</i> Advanced Settings <i class="material-icons pull-right" onclick="$(this).html()=='keyboard_arrow_right'?$(this).html('keyboard_arrow_down'):$(this).html('keyboard_arrow_right')">keyboard_arrow_right</i></span>
				</div>


				<ul class="list-unstyled collapse advance-settings-section" style="height: 100%;">
					<li><a href="<?php echo base_url(); ?>advance/search/"><i class="material-icons">find_in_page</i> Advanced Search</a></li>	
				</ul>




				<div class="row">
					<span class="left-navigation-header"   data-toggle="collapse" data-target=".display-section"><i class="material-icons">desktop_windows</i> Display <i class="material-icons pull-right" onclick="$(this).html()=='keyboard_arrow_right'?$(this).html('keyboard_arrow_down'):$(this).html('keyboard_arrow_right')">keyboard_arrow_right</i></span>
				</div>

				<ul class="list-unstyled collapse display-section" style="height: 100%;">
					<li class="view" id="table"><a href="#"><span class="glyphicon glyphicon-th"></span> Table view</a></li>		
					<li class="view"><a href="#"><span class="glyphicon glyphicon-list"></span> List view</a></li>
					<li class="view"></li>
					<li data-role="none" class="text-muted"><i class="material-icons text-muted">filter_list</i> <span class="text-muted">Filter fields</span></li>
					<li data-role="none" class="divider"></li>
					<li>
						<ul class="list-unstyled" style="font-size: 12px;">

		    				<li>
								<span>
		    						<input type="checkbox" id="recordNumberCheckBox" name="record_number" class="checkbox-group report-field" value="6" data-sort="0" > 

		    						<label for="recordNumberCheckBox"><span></span></label> Record Number
		    					</span>	
		    				</li>

		    				<li>
								<span>
		    						<input type="checkbox" id="descriptionCheckBox" name="description" class="checkbox-group report-field" value="6" data-sort="1"> 

		    						<label for="descriptionCheckBox"><span></span></label> Description
		    					</span>	
		    				</li>


		    				<li>
								<span>
		    						<input type="checkbox" id="keywordsCheckBox" name="keywords" class="checkbox-group report-field" value="6"  data-sort="2" > 

		    						<label for="keywordsCheckBox"><span></span></label> Keywords
		    					</span>	
		    				</li>


		    				<li>
								<span>
		    						<input type="checkbox" id="filesCheckBox" name="files" class="checkbox-group report-field" value="6"  data-sort="3"> 

		    						<label for="filesCheckBox"><span></span></label> Files
		    					</span>	
		    				</li>


		    				<li>
								<span>
		    						<input type="checkbox" id="menuCheckBox" name="menu" class="checkbox-group report-field" value="6"  data-sort="4"> 

		    						<label for="menuCheckBox"><span></span></label> Menu
		    					</span>	
		    				</li>

		    				
		    			</ul>
						
					</li>	



				</ul>


				<div class="row">
					<span class="left-navigation-header active in"  data-toggle="collapse" data-target=".category-section"><i class="material-icons">folder</i> Categories <i class="material-icons pull-right" onclick="$(this).html()=='keyboard_arrow_right'?$(this).html('keyboard_arrow_down'):$(this).html('keyboard_arrow_right')">keyboard_arrow_down</i></span>
				</div>


				<ul class="list-unstyled collapse category-section in">
				
						
							<?php for($x=0;$x<count($data);$x++){ ?>
								<li class="<?php echo set_active($data[$x]->id); ?>" >&emsp;<a href="<?php echo base_url(); ?>?id=<?php echo $data[$x]->id; ?>&category=<?php echo urlencode($data[$x]->category); ?>"><?php echo $data[$x]->category; ?> <small class="text-muted">(<?php echo $data[$x]->code; ?>)</small></a></li>
								
							<?php } ?>
						
					
				</ul>


			</div>
		</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/javascripts/panel.js"></script>