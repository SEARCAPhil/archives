<?php 
    
    global $CI;
    global $total;
    $total = 0;
    function show_categories(){
      global $CI;
      global $total;
    	$CI =& get_instance();
      $categories=$CI->get_all_parent_categories();
      

    	for($x=0;$x<count($categories);$x++){


        $total+=isset($categories[$x]->stats->total) ? $categories[$x]->stats->total : 0;
    		echo 
    		'<div>
    			
    				<div>
    					<b class="category-header">
    						<input type="checkbox" id="'.$categories[$x]->id.'" 
			    				class="checkbox-group checkbox-group-parents checkbox-group-'.$categories[$x]->id.'" 
			    				value="'.$categories[$x]->id.'" disabled="disabled"/> 

    				<label for="'.$categories[$x]->id.'"><span></span></label> <b>'.$categories[$x]->category.'</b>&emsp;<b class="text-danger pull-right">'.$categories[$x]->stats->total.'</b>';

    			
    			show_sub_categories($categories[$x]->id,'checkbox-group checkbox-group-'.$categories[$x]->id);

    		echo '

	    			</div><hr/>
	    		';


    	}	
    }


    function show_sub_categories($id,$group_name=''){
      global $CI;
      global $total;

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

          $total+=isset($sub_categories[$x]->stats->total) ? $sub_categories[$x]->stats->total : 0;

	    		echo 

	    		'<div class="children-div">
	    			<div class="children-div-content" title="'.$sub_categories[$x]->category.'">

	    				<div>|____<input type="checkbox" disabled="disabled" 
	    				id="'.$sub_categories[$x]->id.'" 
	    				value="'.$sub_categories[$x]->id.'" 
	    				'.$checked.'
	    				class="'.$consolidated_group_name.'checkbox-group-'.$sub_categories[$x]->id.'"/> 
	    					<label for="'.$sub_categories[$x]->id.'"><span></span></label> 
	    					<b>'.substr($sub_categories[$x]->category,0,20).'</b>	&emsp;<b class="text-danger pull-right">'.$sub_categories[$x]->stats->total.'</b>
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


<div class="col col-lg-10 large-scrollbar" name="role"  style="height:90vh;overflow-y:auto;padding-bottom:150px;">
	<article class="col col-md-6 col-md-offset-3">

		<div class="col col-md-12" style="margin-bottom: 50px;">

			<div style="float:left;width:100%;height:5px;background: rgba(240,240,240,0.6);margin-bottom: 5px;"></div>
			<div style="float:left;width:100%;height:60px auto;background: rgba(240,240,240,0.6);padding: 10px 10px;">
        <h3>Statistics</h3>
        <p>Total number of encoded documents per category</p>
			</div>
		</div>

		<div class="col col-md-12" style="margin-bottom: 50px;">
			<form>
        <?php show_categories(); ?>
        <b class="text-danger text-larger pull-right">TOTAL: <?php echo $total; ?></b>
			</form>

		</div>


	</article>
</div>
