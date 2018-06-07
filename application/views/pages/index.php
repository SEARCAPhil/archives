<style type="text/css">
	
	.search-box-top{
		background: none;
		border-bottom: 1px solid rgba(192, 97, 83,1.0)
		color:rgb(200,200,200);
	}
	.search-box-top:focus,.search-box-top:active{
		background: none;
		color:rgb(200,200,200);
	}
	.home-banner {
		height: 100vh;
		position:relative;
	}
	.home-banner:after {
		position:absolute;
		content: '';
		width:100%;
		height:100%;
		top:0;
		right:0;
		bottom:0;
		left:0;
		background:url('<?php echo base_url(); ?>assets/images/block-chain.png') no-repeat;
		z-index:-1;
		background-size:cover;
		opacity:0.03;
	}

</style>
	
	<div class="col col-md-10 home-banner">
			<div class="col col-md-12 " style="margin-top: 14vh;">
				<center>
					<img src="<?php echo base_url(); ?>assets/images/storage.png"  width="15%" style="min-width:250px;" />
					<p  class="text-muted">Keep your files safe, organize, and accessible everywhere<br/> Manage your records in a new and better way.</p>


				</center>
	
			</div>

	</div>




