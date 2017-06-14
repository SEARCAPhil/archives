<?php 
global $id;
$id=@$param['id'];
function set_active($sid){
	global $id;

	return $id==$sid?'active':'';
}
?>
<style type="text/css">
	.search-box{
		box-shadow: none;
		border-radius: 0;
		border:none;
		border-bottom: 1px solid #ccc;
	}
	.search-box:focus{
		box-shadow: none;
	}
</style>
<nav class="navbar navbar-inverse navbar-top-fixed navbar-top" style="margin-bottom: 0;">
	<div class="container-fluid">
		<div class="navbar-header">
			<span href="<?php echo base_url(); ?>" class="navbar-brand" data-toggle="collapse" data-target="#right-navbar" style="margin-left:0;color:rgb(255,169,18);"><span class="glyphicon glyphicon-th"></span></span>
			<a href="<?php echo base_url(); ?>" class="navbar-brand"  style="margin-left:0;"><small> </small></a>
		</div>
		<div class="collapse navbar-collapse" id="right-navbar">
			<ul class="nav navbar-nav pull-right">

			<!--permission-->
				<?php if(@$menu['permission']){ ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Permission<span class="caret"></span></a>
						<ul class="dropdown dropdown-menu">
							<li><a href="<?php echo base_url(); ?>role/">Role</a></li>
						</ul>
					</li>
				<?php } ?>
			<!--/permission-->

				<li class="dropdown category-dropdown-button"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <span class="caret"></span></a>
					<ul class="dropdown dropdown-menu">
						<?php for($x=0;$x<count($data);$x++){ ?>
							<li class="<?php echo set_active($data[$x]->id); ?>" ><a href="<?php echo base_url(); ?>?id=<?php echo $data[$x]->id; ?>&category=<?php echo urlencode($data[$x]->category); ?>"><?php echo $data[$x]->category; ?> <small class="text-muted">(<?php echo $data[$x]->code; ?>)</small></a></li>
							
						<?php } ?>
					</ul>
				</li>
				<li><a href="<?php echo base_url(); ?>?logout=true"> Logout</a></li>
				<li><a href="#"> <img src="<?php echo base_url(); ?>assets/images/guest.png"  width="25px" /></a></li>
			</ul>

		</div>
	</div>
</nav>


<?php include_once('panel_category.php'); ?>

		<div class="col col-lg-10 col-sm-9 col-md-9 hidden-xs">
			<div class=" sub-nav row">
				<div class="container-fluid">
					<ul class="nav navbar-nav sub-navigation">
						<li class="dropdown active visible-xs visible-sm"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-bookmark"></span>  Sub Categories <span class="caret"></span></a>
							<ul class="dropdown dropdown-menu">
								<?php for($x=0;$x<count($sub);$x++){ ?>
									<li class="<?php echo set_active($sub[$x]->id); ?>" >
										<a href="<?php echo base_url(); ?>?id=<?php echo $sub[$x]->id; ?>"><?php echo $sub[$x]->category; ?> 
											<small class="text-muted">(<?php echo $sub[$x]->code; ?>)</small>
										</a>
									</li>
									
								<?php } ?>
							</ul>
						</li>
						<li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
						<li><div class="col col-md-12"><form style="margin-top: 7px;margin-bottom: 0px;"><input type="text" class="form-control search-box search-box-top" placeholder="Search" name="search" value="<?php echo utf8_encode($this->input->get('search')); ?>"/></form></div></li>
												<li class="view hidden-sm" id="table"><a href="#"><span class="glyphicon glyphicon-th"></span> Table view</a></li>		
						<li class="view hidden-sm"><a href="#"><span class="glyphicon glyphicon-list"></span> List view</a></li>
					</ul>

			<!--materials-->
				<?php if($menu['materials']){ ?>
					<ul class="nav navbar-nav sub-navigation pull-right">
						<li>
							<a href="<?php echo base_url(); ?>form/">&nbsp;Add 
								<div style="float: left;width:20px;height:20px;background: rgb(255,100,99);border-radius: 50%;color:rgb(255,255,255);text-align: center;">+</div>
							</a>
						</li>
					</ul>
				<?php } ?>


				</div>
			</div>
		</div>





<script type="text/javascript">
$(document).ready(function(){
	$('.view').click(function(){
		if(this.id=='table'){
			document.cookie="dms-view=table;path=/";
		}else{
			document.cookie="dms-view=list;path=/";
		}

		var currentLocation = window.location;
		window.location=document.location.toString().toLowerCase()
	})
})
</script>