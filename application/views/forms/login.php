
<div class="col col-md-5 col-md-offset-3" ng-controller="loginController" style="margin-top: 4%;">

<!--login form-->
<div class="row col-md-12  col-xs-12 pull-right loginForm ">

	<center>
		<img src="<?php echo base_url(); ?>assets/images/searca.png" width="60%">
	</center>
	<div class="col col-md-9 col-md-offset-2">
		<center><h3 class="page-header">Document Management System</h3></center>
	</div>

	<!--<div class="page-header col col-md-10 row">
		<h2>Supporting Documents for Financial Transaction <small>Management System</small></h2>
	</div>-->

 
<?php echo form_open('home/authentication','class="form-horizontal",action='.$_SERVER['PHP_SELF']); ?>
<?php if($data){ ?>
  <div class=" col col-md-9 col-md-offset-2">
  	<div class="alert alert-danger">
  		<p>Oopss! Invalid username or password!</p>
  		<p class="text-important">Is this your account? <small><a href="<?php echo base_url(); ?>">not my account.</a></small></p>
  	</div>
  </div>
<?php } ?>

  
<div class="col col-md-10 col-md-offset-2 row">	

		<div class="form-group col col-md-11 has-feedback">
    	   <label for="inputUser">Username</label>
     	  	
     	  		<input type="text" class="form-control" id="inputUser" placeholder="username" name="username" ng-model="username" required>   	   
   		 		<!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
   		 </div>
   		 <div class="form-group col col-md-11 ">
     	   <label for="inputPassword">Password</label>
     	   <div>
        		<input type="password" class="form-control" placeholder="Password" id="inputPassword" name="password" ng-model="password" required>
     	   </div>
   		 </div>
       <!--submit-button-->
   		 <div class="form-group col col-md-12 ">
    		<button class="btn btn-primary">Login</button>
  		 </div>
  	  <!--end submit button-->

</div>
<!--end login-form-->
</div>

<!--end content-->
</artice>
