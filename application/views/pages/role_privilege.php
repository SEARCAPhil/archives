<?php
    
    global $CI;

    function show_categories(){
    	global $CI;
    	$CI =& get_instance();

    	$categories=$CI->get_all_parent_categories();

    	for($x=0;$x<count($categories);$x++){
    		$checked='false';
    		$checked_read='false';
    		$checked_write='false';
    		$checked_update='false';
    		$checked_delete='false';

    		if(isset($categories[$x]->attributes->read_privilege)){
    			$checked='checked="checked"';

    			//check other attributes
    			if($categories[$x]->attributes->read_privilege==1){
    				$checked_read='checked="checked"';
    			}

    			if($categories[$x]->attributes->write_privilege==1){
    				$checked_write='checked="checked"';
    			}

    			if($categories[$x]->attributes->update_privilege==1){
    				$checked_update='checked="checked"';
    			}

    			if($categories[$x]->attributes->delete_privilege==1){
    				$checked_delete='checked="checked"';
    			}
    		}

    		echo 

    		'<div>
    			
    				<div>
    					<b class="category-header">
    						<input type="checkbox" id="'.$categories[$x]->id.'" 
			    				class="checkbox-group checkbox-group-parents checkbox-group-'.$categories[$x]->id.'" 
			    				value="'.$categories[$x]->id.'" 
			    				'.$checked.'
			    				 data-read="'.@$categories[$x]->attributes->read_privilege.'" 
			    				 data-write="'.@$categories[$x]->attributes->write_privilege.'" 
			    				 data-update="'.@$categories[$x]->attributes->update_privilege.'" 
			    				 data-remove="'.@$categories[$x]->attributes->delete_privilege.'"/> 

    				<label for="'.$categories[$x]->id.'"><span></span></label> '.$categories[$x]->category.'</b>';

    				echo '<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-read" 
		    						value="'.$categories[$x]->id.'" 
		    						'.$checked_read.'
		    						class="small checkbox-group-set-read '.$categories[$x]->id.'-menu" 
		    						data-parent="'.$categories[$x]->id.'"/>

		    						<label for="'.$categories[$x]->id.'-read"><span></span></label>  
		    						<span>Read</span>
		    					</u>
	    					</span>

	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-write" 
		    						value="'.$categories[$x]->id.'" 
		    						'.$checked_write.'
		    						class="small checkbox-group-set-write '.$categories[$x]->id.'-menu"  
		    						data-parent="'.$categories[$x]->id.'"/>
		    						<label for="'.$categories[$x]->id.'-write"><span></span></label>  
		    						<span>Write</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-update" 
		    						value="'.$categories[$x]->id.'" 
		    						class="small checkbox-group-set-update '.$categories[$x]->id.'-menu" 
		    						'.$checked_update.' 
		    						data-parent="'.$categories[$x]->id.'"/>
		    						<label for="'.$categories[$x]->id.'-update"><span></span></label>  
		    						<span>Update</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$categories[$x]->id.'-remove" 
		    						value="'.$categories[$x]->id.'" 
		    						'.$checked_delete.'
		    						class="small checkbox-group-set-remove '.$categories[$x]->id.'-menu"  
		    						data-parent="'.$categories[$x]->id.'"/>
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

	    		$checked='false';
	    		$checked_read='false';
	    		$checked_write='false';
	    		$checked_update='false';
	    		$checked_delete='false';

	    		if(isset($sub_categories[$x]->attributes->read_privilege)){
	    			$checked='checked="checked"';

	    			//check other attributes
	    			if($sub_categories[$x]->attributes->read_privilege==1){
	    				$checked_read='checked="checked"';
	    			}

	    			if($sub_categories[$x]->attributes->write_privilege==1){
	    				$checked_write='checked="checked"';
	    			}

	    			if($sub_categories[$x]->attributes->update_privilege==1){
	    				$checked_update='checked="checked"';
	    			}

	    			if($sub_categories[$x]->attributes->delete_privilege==1){
	    				$checked_delete='checked="checked"';
	    			}
	    		}


	    		echo 

	    		'<div class="children-div">
	    			<div class="children-div-content" title="'.$sub_categories[$x]->category.'">

	    				<div>|____<input type="checkbox"
	    				id="'.$sub_categories[$x]->id.'" 
	    				value="'.$sub_categories[$x]->id.'" 
	    				'.$checked.'
						data-read="'.@$sub_categories[$x]->attributes->read_privilege.'" 
	    				data-write="'.@$sub_categories[$x]->attributes->write_privilege.'" 
	    				data-update="'.@$sub_categories[$x]->attributes->update_privilege.'" 
	    				data-remove="'.@$sub_categories[$x]->attributes->delete_privilege.'"
	    				class="'.$consolidated_group_name.'checkbox-group-'.$sub_categories[$x]->id.'"/> 
	    					<label for="'.$sub_categories[$x]->id.'"><span></span></label> 
	    					<b>'.substr($sub_categories[$x]->category,0,20).'</b>
	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-read" 
		    						value="'.$sub_categories[$x]->id.'" 
		    						class="small checkbox-group-set-read '.$sub_categories[$x]->id.'-menu" 
		    						'.$checked_read.'
		    						data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-read"><span></span></label>  
		    						<span>Read</span>
		    					</u>
	    					</span>

	    					<span>
	    						<u>
		    						<input type="checkbox" 
		    						id="'.$sub_categories[$x]->id.'-write" 
		    						value="'.$sub_categories[$x]->id.'" 
		    						class="small checkbox-group-set-write '.$sub_categories[$x]->id.'-menu"  
		    						'.$checked_write.'
		    						data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-write"><span></span></label>  
		    						<span>Write</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-update" 
		    						value="'.$sub_categories[$x]->id.'" 
		    						class="small checkbox-group-set-update '.$sub_categories[$x]->id.'-menu"
		    						'.$checked_update.'  
		    						data-parent="'.$sub_categories[$x]->id.'"/>
		    						<label for="'.$sub_categories[$x]->id.'-update"><span></span></label>  
		    						<span>Update</span>
		    					</u>
	    					</span>



	    					<span>
	    						<u>
		    						<input type="checkbox" id="'.$sub_categories[$x]->id.'-remove" 
		    						value="'.$sub_categories[$x]->id.'" 
		    						'.$checked_delete.'
		    						class="small checkbox-group-set-remove '.$sub_categories[$x]->id.'-menu"  
		    						data-parent="'.$sub_categories[$x]->id.'"/>
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


<div class="modal fade" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body row modal-content-body">

      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="col col-lg-10 large-scrollbar" name="role" data-content="<?php echo ucfirst($role[0]->id); ?>"  style="height:90vh;overflow-y:auto;padding-bottom:150px;">
	<article class="col col-md-10 col-md-offset-1">

		<div class="col col-md-12" style="margin-bottom: 50px;">
			<h3><?php echo ucfirst($role[0]->role); ?></h3>
			<p><?php echo ucfirst($role[0]->description); ?></p>
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
							
							<span><div class="save-button" data-toggle="modal" data-target="#modal"> <span class="glyphicon glyphicon-floppy-disk"></span></div>&nbsp;<b>Save</b></span>
					

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