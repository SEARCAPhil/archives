
<div class="col col-sm-9 col-md-9 col-lg-8 col-lg-offset-1" name="role">
	<?php for($x=0;$x<count($role); $x++){ ?>
		<article class="col col-md-12">

			<div class="col col-md-12" style="margin-bottom: 50px;">
				<h3><a href="?role_id=<?php echo ucfirst($role[$x]->id); ?>"><?php echo ucfirst($role[$x]->role); ?></a></h3>
				<p><?php echo ucfirst($role[$x]->description); ?></p>
				<div style="float:left;width:100%;height:5px;background: rgba(240,240,240,0.6);margin-bottom: 5px;"></div>
				<div style="float:left;width:100%;height:60px auto;background: rgba(240,240,240,0.6);padding: 10px 10px;">
				
					
						
				</div>
			</div>

		</article>
	<?php } ?>
</div>
