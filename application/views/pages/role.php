<?php
    
    global $CI;

    function show_categories(){
    	global $CI;
    	$CI =& get_instance();

    	$categories=$CI->get_all_parent_categories();

    	for($x=0;$x<count($categories);$x++){
    		echo 

    		'<div>
    			
    				<div><b class="category-header"><input type="checkbox" id="'.$categories[$x]->id.'" class="checkbox-group checkbox-group-'.$categories[$x]->id.'" value="'.$categories[$x]->id.'"/> <label for="'.$categories[$x]->id.'"><span></span></label> '.$categories[$x]->category.'</b>';

    				echo '<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-read" value="'.$categories[$x]->id.'" class="small checkbox-group-set-read '.$categories[$x]->id.'-menu" data-parent="'.$categories[$x]->id.'"/>
		    						<label for="'.$categories[$x]->id.'-read"><span></span></label>  
		    						<span>Read</span>
		    					</u>
	    					</span>

	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-write" value="'.$categories[$x]->id.'" class="small checkbox-group-set-write '.$categories[$x]->id.'-menu"  data-parent="'.$categories[$x]->id.'"/>
		    						<label for="'.$categories[$x]->id.'-write"><span></span></label>  
		    						<span>Write</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-update" value="'.$categories[$x]->id.'" class="small checkbox-group-set-update '.$categories[$x]->id.'-menu"  data-parent="'.$categories[$x]->id.'"/>
		    						<label for="'.$categories[$x]->id.'-update"><span></span></label>  
		    						<span>Update</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-remove" value="'.$categories[$x]->id.'" class="small checkbox-group-set-remove '.$categories[$x]->id.'-menu"  data-parent="'.$categories[$x]->id.'"/>
		    						<label for="'.$categories[$x]->id.'-remove"><span></span></label>  
		    						<span>Remove</span>
		    					</u>
	    					</span>
	    					
	    				</div>';

    			show_sub_categories($categories[$x]->id,'checkbox-group checkbox-group-'.$categories[$x]->id);

    		echo '

	    			</div><hr/>
	    		';


    	}	
    }


    function show_sub_categories($id,$group_name=''){
    	global $CI;

    	$sub_categories=$CI->get_all_children_categories($id);

    	if(!isset($consolidated_group_name)) $consolidated_group_name='';

    	//add to group stack
    	$consolidated_group_name.=$group_name.' ';

	    	for($x=0;$x<count($sub_categories);$x++){

	    		echo 

	    		'<div class="children-div">
	    			<div class="children-div-content" title="'.$sub_categories[$x]->category.'">

	    				<div>|____<input type="checkbox" id="'.$sub_categories[$x]->id.'" value="'.$sub_categories[$x]->id.'" class="'.$consolidated_group_name.'checkbox-group-'.$sub_categories[$x]->id.'"/> 
	    					<label for="'.$sub_categories[$x]->id.'"><span></span></label> 
	    					<b>'.substr($sub_categories[$x]->category,0,20).'</b>
	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-read" value="'.$sub_categories[$x]->id.'" class="small checkbox-group-set-read '.$sub_categories[$x]->id.'-menu" data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-read"><span></span></label>  
		    						<span>Read</span>
		    					</u>
	    					</span>

	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-write" value="'.$sub_categories[$x]->id.'" class="small checkbox-group-set-write '.$sub_categories[$x]->id.'-menu"  data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-write"><span></span></label>  
		    						<span>Write</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-update" value="'.$sub_categories[$x]->id.'" class="small checkbox-group-set-update '.$sub_categories[$x]->id.'-menu"  data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-update"><span></span></label>  
		    						<span>Update</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-remove" value="'.$sub_categories[$x]->id.'" class="small checkbox-group-set-remove '.$sub_categories[$x]->id.'-menu"  data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-remove"><span></span></label>  
		    						<span>Remove</span>
		    					</u>
	    					</span>
	    					
	    				</div>

	    			</div>';

	    			show_sub_categories($sub_categories[$x]->id,$consolidated_group_name.' checkbox-group-'.$sub_categories[$x]->id);

	    		echo '</div>';


	    	}
    }
?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url().'assets/stylesheets/role.css'; ?>">
<div class="container">
	<article class="col col-md-10 col-md-offset-1">

		<div class="col col-md-12" style="margin-bottom: 50px;">
			<h3>Human_resource</h3>
			<p>To ensure that house rentals and bills on utilities are paid regularly. 
	When applying for a leave of absence for one month or more, a clearance must be filed and approved. 
	Arrangements should be made for the payment of house rental for the period that the SEARCA staff is on leave. 
	SEARCA apartments will be for the occupancy of SEARCA staff and immediate members of the family only. </p>
			<div style="float:left;width:100%;height:5px;background: rgba(240,240,240,0.6);margin-bottom: 5px;"></div>
			<div style="float:left;width:100%;height:60px auto;background: rgba(240,240,240,0.6);padding: 10px 10px;">
				<p style="color:rgb(50,154,234);"><b>Options :</b></p>
				<p>
					<ul class="list-unstyled">
						<li>
							<span>	
								<input type="checkbox" class="checkbox-group-all" id="checkbox-group-all"/>
								<label for="checkbox-group-all"><span></span></label> 
								<b>Check/Uncheck All</b>
							</span>

						</li>
						<li>
							<span>
								<input type="checkbox" class="checkbox-group-grant-read" id="checkbox-group-grant-read"/>
								<label for="checkbox-group-grant-read"><span></span></label> 
								<b>Grant/Revoke Read</b>
							</span>

							<span>&emsp;
								<input type="checkbox" class="checkbox-group-grant-write" id="checkbox-group-grant-write"/>
								<label for="checkbox-group-grant-write"><span></span></label> 
								<b>Grant/Revoke Write</b>
							</span>


							<span>&emsp;
								<input type="checkbox" class="checkbox-group-grant-update" id="checkbox-group-grant-update"/>
								<label for="checkbox-group-grant-update"><span></span></label> 
								<b>Grant/Revoke Update</b>
							</span>

							<span>&emsp;
								<input type="checkbox" class="checkbox-group-grant-remove" id="checkbox-group-grant-remove"/>
								<label for="checkbox-group-grant-remove"><span></span></label> 
								<b>Grant/Revoke Remove</b>
							</span>

						</li>
						<li>
							
							<span><div class="save-button"><span class="glyphicon glyphicon-floppy-disk"></span></div>&nbsp;<b>Save</b></span>
					

						</li>
					
					
				</p>
				
				
					
			</div>
		</div>

		<div class="col col-md-12" style="margin-bottom: 50px;">
			<form>
				<?php show_categories(); ?>
			</form>

		</div>


	</article>
</div>
<script type="text/javascript" src="<?php echo site_url().'assets/javascripts/role.js'; ?>"></script>