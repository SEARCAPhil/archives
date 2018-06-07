<?php 	
	$page=$this->input->get('page',true)!=null?$this->input->get('page',true):1; 
	$id=($this->input->get('id',true)); 
?>

<?php include_once('panel_subcategory.php'); ?>


<?php if(@$items['total']>0): ?>
<div class="col col-lg-8 col-sm-9 col-md-6 col-xs-12 pull-right document-header">
	<div class="text-muted  text-center	 col col-lg-3 col-md-6 col-sm-6 col-xs-6" style="border-right: 1px solid rgb(240,240,240);">
		<h3><b><?php echo @($items['total']); ?> Files <i class="material-icons md-24">insert_drive_files</i></b></h3>
		<p><small>Available under this category</small></p>

	</div>

	<div class="text-muted  col-lg-3 col-md-6 col-sm-6 col-xs-6 text-center" onclick="window.open('report/lists/?id=<?php echo @$items['data'][0]->cat_id; ?>&page=<?php echo @$items['current_page']<=0?1:$items['current_page']; ?>');">
		<h3><b> <i class="material-icons md-36">print</i></b></h3>
		<p>PRINT</p>

	</div>
</div>
<?php endif; ?>

<?php if(!isset($items['total'])){ ?>

	<center>
		<i class="material-icons" style="font-size: 12em;margin-top: 5vh;">cloud_off</i>

		<h2 class="text-muted">Empty section</h2>
		<p  class="text-muted">This page doesn't contain any document. Please check back soon!</p>


	</center>

<?php } ?>



<div class="col col-lg-8 col-sm-9 col-md-6 col-xs-12 large-scrollbar dark-scrollbar" style="height:80vh;overflow-y:auto;overflow-x:auto;">

	<div class="row">
		
		<?php if(count($details)>0){ ?>

		<?php 
			#if no result
			if(count(@$items['data'])<=0){ 
		?>


				<?php if (@$x<1&&isset($items['total'])){?>	

					<center style="margin-top:10vh;">
						<h1 class="text-muted">Error 404</h1>

						<p class="text-danger">No content available</p>
						<p  class="text-muted">Keep your files safe, organize, and accessible everywhere</p>
						</center>
				<?php } ?>


		<?php  } ?>

		<?php if(!isset($_COOKIE['dms-view'])){$_COOKIE['dms-view']='table';} ?>

		<?php if(@$_COOKIE['dms-view']=='table'){ ?>
				<?php include_once('list_table_view.php'); ?>
		<?php }else{ ?>
				<?php include_once('list_list_view.php'); ?>
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


		<?php } ?>

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