
<div style="margin-top: 4%;">

<!--login form-->
<div class="loginForm ">



	<!--<div class="page-header col col-md-10 row">
		<h2>Supporting Documents for Financial Transaction <small>Management System</small></h2>
	</div>-->

 
<?php echo form_open('home/authentication','class="form-horizontal",action='.$_SERVER['PHP_SELF']); ?>

<style type="text/css">
  input[type="text"],input[type="password"]{
    border:none;
    border-bottom: 1px solid #ccc !important;
    border-radius: 0 !important;
    -webkit-border-radius: 0 !important;
    padding:20px;
    box-shadow: none;
  }

  input[type="text"]:focus,input[type="password"]:focus{
    box-shadow: none;
  }

  .btn-submit{
    background: rgb(55,164,249);
    color:rgb(255,255,255);
    padding: 10px;
    border-radius: 20px;
  }

  .searca-about,.searca-footer{
    font-size: 9px;
    margin-top: 50px;
  }
  .searca-footer{
    line-height: 0;
    margin-top: 60px;
  }
  .alert-danger{
    background: rgba(255,99,33,0.3);
  }
</style>
  
<div class="col col-lg-4 col-lg-offset-4 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">	

        <div class="row">
         <div class="col col-md-12 text-center" style="min-width: 70px !important;">
            <!--  <img src="<?php echo base_url(); ?>assets/images/logo-new.png" width="100px">-->
            <img src="<?php echo base_url(); ?>assets/images/logo-new.png" width="260px">
            <h1></h1>
          </div>

          <div class="col col-md-12 text-center" style="margin-bottom: 20px;">
            <h1 style="padding-right: 0px !important;"> Sign In </h1>
            <p><small class="text-muted">Document Management System</b></small></p>
          </div>
        </div>

		  <div class="form-group col col-md-12 text-center"  style="margin-bottom: 30px;">
     	  		<input type="text" class="form-control text-center" id="inputUser" placeholder="Username" name="username" required autocomplete="off">   	   
   		 		<!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
   		 </div>
   		 <div class="form-group col col-md-12"  style="line-height: 0;margin-bottom: 30px;">
     	  
     	   <div>
        		<input type="password" class="form-control text-center" placeholder="Password" id="inputPassword" name="password" required>
     	   </div>
   		 </div>



        <?php if($data){ ?>
          <div class=" col col-md-12 row">
            <div class="alert alert-danger">
              <p>Oopss! Invalid username or password!</p>
              <p class="text-important">Is this your account? <small><a href="<?php echo base_url(); ?>">not my account.</a></small></p>
            </div>
          </div>
        <?php } ?>



       <!--submit-button-->
   		 <div class="form-group col col-md-12 " style="margin-top: 30px;">
    		<button class="btn btn-block btn-submit">Login</button>
  		 </div>


</div>

<!--end login-form-->


</div>



<!--end content-->
</artice>
