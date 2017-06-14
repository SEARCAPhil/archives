<div class="col col-lg-2 col-sm-2 col-md-3 pull-left hidden-sm hidden-xs" style="font-size: 0.9em;height: 100%;">
	<div class="row" style="background: rgb(60,60,60); padding: 5px 0px 5px 30px;color:rgb(250,250,250);">

		<p><span class="text-muted"><b><?php echo $details[0]->category; ?></b> \ </span><b>Sub-categories</b> <i class="material-icons md-18">keyboard_arrow_down</i></p>
	</div>

	<div class="col col-md-12 row">
		<ul class="list-unstyled navigation-sub-nav">
			<?php for($x=0;$x<count($sub);$x++){ ?>
				<li class="<?php echo set_active($sub[$x]->id); ?>" >
					<i class="material-icons">folder</i>
					<a href="<?php echo base_url(); ?>?id=<?php echo $sub[$x]->id; ?>"><?php echo $sub[$x]->category; ?> 
						<small class="text-muted">(<?php echo $sub[$x]->code; ?>)</small>
					</a>
				</li>
				
			<?php } ?>
		</ul>

		<?php if(count($sub)<=0){ ?>
			<center class="text-muted">
				<i class="material-icons md-24">inbox</i>
				<p>Empty Sub-category List</p>
			</center>
		<?php } ?>
	</div>
</div>
