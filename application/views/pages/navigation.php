<?php 
global $id;
$id=@$param['id'];
function set_active($sid){
	global $id;

	return $id==$sid?'active':'';
}
?>
<nav class="navbar navbar-inverse navbar-top-fixed navbar-top">
	<div class="container">
		<div class="navbar-header">
			<a href="/dms" class="navbar-brand">Document Management System</a>
		</div>
		<div class="collapse navbar-collapse pull-right">
			<ul class="nav navbar-nav">
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <span class="caret"></span></a>
					<ul class="dropdown dropdown-menu">
						<?php for($x=0;$x<count($data);$x++){ ?>
							<li class="<?php echo set_active($data[$x]->id); ?>" ><a href="<?php echo base_url(); ?>?id=<?php echo $data[$x]->id; ?>&category=<?php echo urlencode($data[$x]->category); ?>"><?php echo $data[$x]->category; ?> <small class="text-muted">(<?php echo $data[$x]->code; ?>)</small></a></li>
							
						<?php } ?>
					</ul>
				</li>
				<li><a href="<?php echo base_url(); ?>?logout=true"> <span class="glyphicon glyphicon-off"></span> Logout</a></li>
			</ul>

		</div>
	</div>
	<div class=" sub-nav">
		<div class="container">
			<ul class="nav navbar-nav sub-navigation">
				<li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Sub Category <span class="caret"></span></a>
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
				<li class="view" id="table"><a href="#"><span class="glyphicon glyphicon-th"></span> Table view</a></li>		
				<li class="view"><a href="#"><span class="glyphicon glyphicon-list"></span> List view</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-search"></span> search</a></li>
				<li><form style="margin-top: 7px;margin-bottom: 0px;"><input type="text" class="form-control" name="search" value="<?php echo utf8_encode($this->input->get('search')); ?>"/></form></li>
			</ul>

			<ul class="nav navbar-nav sub-navigation pull-right">
				<li><a href="<?php echo base_url(); ?>form/">Add <label class="label label-warning"><small><span class="glyphicon glyphicon-plus"></span></small></label></a></li>
			</ul>
		</div>
	</div>
</nav>
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