<style>
    .main-login {
        height:100vh;
        overflow:hidden;
    }
    .main-login-banner {
        height:100vh;
        padding-top:20%;
        color:rgb(255,255,255);
        z-index:1;
        position:relative;
    }

    .main-login-backdrop {
        float:left;
        position:absolute;
        width:100%;
        height:100%;
        top:0;
         background:rgba(0,0,0,0.8);
         z-index:1;
    }

    .main-login-banner-text {
        float:left;
        position:absolute;
        width:100%;
        height:100%;
        top:40vh;
        z-index:2;
    }


    .green {
        color: #23f98b;
    }

    .sub-login-banner {
        padding-top:7%;
        position:relative;
        height:100%;
        overflow:hidden;
        overflow-y: auto;
    }
    .go-to-app-btn {
        border-radius: 50px;
    }
    .doodle-section {
        height:100%;
        width:100%;
        background:url('<?php echo base_url(); ?>assets/images/doodle.png') no-repeat;
        overflow:hidden;
        position:absolute;
        z-index:0;
        top:35%;
    }
    .sub-banner-deco {
        position:absolute;
        height:100px;
        width:100%;
        background:url('<?php echo base_url(); ?>assets/images/sub-banner-deco.png') no-repeat;
        background-size:cover;
        overflow:hidden;
        bottom:0;
    }
</style>
<article class="main-login row">
 
    <section class="col col-lg-7 main-login-banner">
        <div class="container col-lg-offset-1 col-sm-offset-2 col-xs-offset-1 main-login-banner-text"> 
            <h2>Documents Management System</h2>
            <p class="text-muted">Manage and <span class="green">access</span> your files <span class="green">everywhere</span></small></p>

            <button class="btn btn-office365 btn-lg btn-dark btn-submit go-to-app-btn" type="button" style="color:#fff;background:#ff0763">Login with Office365</button>
        </div>
        <div class="main-login-backdrop"></div>
        <div class="doodle-section"></div>
    </section>



    <section class="col col-lg-5 sub-login-banner">
        <div class="sub-banner-deco"></div>
        <div class="col-lg-10 col-lg-offset-1">
            <img src="<?php echo base_url(); ?>assets/images/searca-new.png" width="150px">
            <p>What makes it a powerful  system for handling <br/>your records and documents?</p>
            <br/>


            <div class="media">
                <div class="media-left">
                <img src="<?php echo base_url(); ?>assets/images/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Well structured and organized</h4>
                    <p><small>Classified your records based on categories for easy retrieval of data</small></p>
                </div>
                <hr/>
            </div>

             <div class="media">
                <div class="media-left">
                <img src="<?php echo base_url(); ?>assets/images/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Safe and secured</h4>
                    <p><small>Stored your data in the cloud with security and privacy. By using your Office365 account, you gain 1 more extra security layer to protect your files against hackers and viruses  </small></p>
                </div>
                <hr/>
            </div>

             <div class="media">
                <div class="media-left">
                <img src="<?php echo base_url(); ?>assets/images/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Accessible everywhere</h4>
                    <p><small>Retrieve your files anytime and everytime in the world!</small></p>
                </div>
                <hr/>
            </div>

            <br/>
            <br/>
            <p>
                <small>By signing in to DMS you agree to <span class="text-success">Users License agreement</span> and <span class="text-success">Data policy</span> settings of SEARCA</small>
            </p>

        </div> 
        <?php echo form_open('authentication/o365','style="display:none;" class="form-horizontal" id="o365Form" action='.$_SERVER['PHP_SELF']); ?>
        <input type="text" name="o365" id="o365"/>
        <input type="text" name="loc" id="loc" value="<?php echo @$_GET['loc'] ?>"/>
        <input type="text" name="redirect" id="redirect" value="<?php echo @$_GET['redirect'] ?>"/>
        
    </section>

<!--end content-->
</artice>

<script type="text/javascript" src="<?php echo base_url(); ?>node_modules/adal-angular/dist/adal.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascripts/auth.js"></script>