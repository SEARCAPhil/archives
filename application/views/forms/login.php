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
        background:url('assets/images/doodle.png') no-repeat;
        overflow:hidden;
        position:absolute;
        z-index:0;
        top:35%;
    }
    .sub-banner-deco {
        position:absolute;
        height:100px;
        width:100%;
        background:url('assets/images/sub-banner-deco.png') no-repeat;
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
                    <h4 class="media-heading">Well keep and organized</h4>
                    <p><small>Excellent feature! I love it. One day I'm definitely going to put this Bootstrap component into use and I'll let you know once I do.</small></p>
                </div>
                <hr/>
            </div>

             <div class="media">
                <div class="media-left">
                <img src="<?php echo base_url(); ?>assets/images/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Safe and secured</h4>
                    <p><small>Excellent feature! I love it. One day I'm definitely going to put this Bootstrap component into use and I'll let you know once I do.</small></p>
                </div>
                <hr/>
            </div>

             <div class="media">
                <div class="media-left">
                <img src="<?php echo base_url(); ?>assets/images/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Accessible everywhere</h4>
                    <p><small>Excellent feature! I love it. One day I'm definitely going to put this Bootstrap component into use and I'll let you know once I do.</small></p>
                </div>
                <hr/>
            </div>

            <br/>
            <br/>
            <p>
                <small>By signing in to DTS you agree to <span class="text-success">Users License agreement</span> and <span class="text-success">Data policy</span> settings of SEARCA</small>
            </p>

        </div> 
        
        
    </section>

<!--end content-->
</artice>
