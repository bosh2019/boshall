  <?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
$userid=$_SESSION['id'];
$User_details=GetRegisterationDetails($conn,$userid);
$firstname=ucfirst($User_details['fname']);
?>
 
   <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/css/reset.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/css/plugins.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/css/style.css?ver1.0"> 
        <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/css/responsive.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/css/color.css">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/css/responsive.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $baseurl;?>/dist/notie.css">
        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseurl;?>/images/favicon.png">

<?php // die; ?>
        <style>
		.modal-body {
    display: inline-block!important;
}
   
	.box-widget-wrap.sidebar {
    position: fixed;
    top: 22%;
    width: 29%;
		
	}
	   .box-widget-wrap
	   {
		   margin-bottom: 30px;
	   }
	   .owl-nav button {
      position: absolute;
    top: 32%;
    transform: translateY(-50%);
    /* background: rgba(255, 255, 255, 0.38) !important; */
}
	   .owl-nav .owl-prev span {
    font-size: 8em;
    color: #939393;
    font-weight: 100;
    position: relative;
    left: -30px;
}
	     .owl-nav .owl-next span {
    font-size: 8em;
    color: #939393;
    font-weight: 100;
    position: relative;
    left: 30px;
}
.owl-nav button.owl-prev {
  left: 0;
}
.owl-nav button.owl-next {
  right: 0;
}

.owl-dots {
  text-align: center;
  padding-top: 15px;
	display: none;
}
.owl-dots button.owl-dot {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  display: inline-block;
  background: #ccc;
  margin: 0 3px;
}
.owl-dots button.owl-dot.active {
  background-color: #000;
}
.owl-dots button.owl-dot:focus {
  outline: none;
}
.tour {
    font-size: 24px;
    margin-bottom: 20px;
}
/*
.color-bg {
    width: 38px;
    border: 1px solid #4db7fe;
    border-radius: 2px;
    font-size: 18px;
    font-weight: 400;
	margin-top: 20px;
	margin-bottom: 10px;
	cursor: pointer;
}
*/
	   .free {
    color: #919191;
    font-weight: 500;
}
		</style>
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.png">
    </head>
    <body>
        <!--loader-->
        <!--<div class="loader-wrap">
            <div class="pin"></div>
            <div class="pulse"></div>
        </div>-->
        <!--loader end-->
        <!-- Main  -->
    <div id="wrapper"> 
  <div class="overlay"></div>
  
          
            <!-- header-->
   <header class="main-header dark-header fs-header sticky">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a href="<?php echo $baseurl;?>"><img src="<?php echo $baseurl;?>/images/logo.png" alt=""></a>
                    </div>
                    
                    
                    
                   <?php if($userid=="")
				   {?> 
                   
                    <div class="show-reg-form modal-open"><a class="btn-home" href="#" data-toggle="modal" data-target="#reg">Sign In</a></div>
                    <?php } else{?>
                    
                    <div class="header-user-menu"> 
                        <div class="header-user-name">
                           Welcome <?php echo $firstname;?>
                        </div>
                        <ul>
                         
                            <li><a href="<?php echo $baseurl;?>/log-out">Log Out</a></li>
                        </ul>
                    </div>

                    <?php }?>
                    <!-- nav-button-wrap-->
                    <div class="nav-button-wrap color-bg">
                        <div class="nav-button">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <!-- nav-button-wrap end-->
                    <!--  navigation -->
                    <div class="nav-holder main-menu">
                        <nav>
                            <ul>
                          
                                <li> <a href="tel:1-617-663-8864" class="act-link">1-617-663-8864 </a>  </li>
                                
                                  <li>
                              <a href="javascript:void(0)" class="act-link">Buy <i class="fa fa-caret-down"></i></a>
                                 <ul>
                                  <li><a href="<?= $baseurl;?>/buy">Buy with BoshALL</a></li>
                                 <!--  <li><a href="#">Home Buying Guide</a></li>-->
                                 </ul>
                           </li>
                           
                            <li>
                              <a href="javascript:void(0)" class="act-link">Sell <i class="fa fa-caret-down"></i></a>
                                 <ul>
                                  <li><a href="<?php echo $baseurl;?>/why-sell">Sell with BoshALL</a></li>
                                  <!-- <li><a href="#">Home selling Guide</a></li>-->
                                 </ul>
                           </li>
                           <li> <a href="<?php echo $baseurl;?>/buy" class="act-link">Bosh Agent</a> </li>
                         <!--  <li> <a href="#" class="act-link">Featured Location</a>  </li>-->
                        <!--   <li> <a href="#" class="act-link">Testimonial</a>  </li>-->
                                
                               

                                <?php if($userid!="")
								{?>
                            <li> <a href="<?php echo $baseurl;?>/my-wishlist">Wishlist</a></li> 

                                <?php }?>
                               <!-- <li> <a href="#">Sell</a></li>-->
                              
                            </ul>
						</nav>
                        <div>
                    </div>
                    <!-- navigation  end -->
                </div>
				</div>
                <input type="hidden" name="userid" id="u_id" value="<?php echo $userid;?>"> 
            </header>
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
     
      <li class="sidebar-brand"> <a href="#"><img src="../images/logo.png" style="width:160px"> </a> </li>
      <li><a href="tel:1-617-663-8864" class="act-link"><i class="fa fa-phone"> </i> 1-617-663-8864 </a></li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Buy <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
			 <li><a href="buy-with-boshall.php">Buy with Boshall</a></li> 
         <!-- <li><a href="#">Home buying guide</a></li>-->
          
        </ul>
      </li>
      <li class="dropdown"> <a href="<?php echo $baseurl;?>/sell" class="dropdown-toggle" data-toggle="dropdown"> Sell <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
		 <li><a href="sell-with-boshall.php">Sell with Boshall</a></li>
        <!--  <li><a href="#">Home selling guide</a></li>-->
          
        </ul>
      </li>
      <li> <a href="<?php echo $baseurl;?>/buy-with-boshall.php" class="act-link">Bosh Agent</a>  </li>
        <?php if($userid!="")
								{?>
                            <li> <a href="<?php echo $baseurl;?>/my-wishlist">Wishlist</a></li> 

                                <?php }?>
    <!--  <li> <a href="#">Testimonial</a> </li>-->
     
      
    </ul>
  </nav>
  <!-- /#sidebar-wrapper --> 
<div id="page-content-wrapper">
    <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas"> <span class="hamb-top"></span> <span class="hamb-middle"></span> <span class="hamb-bottom"></span> </button>
 
    <a href="<?php echo $baseurl;?>" style="float:left"><img src="<?php echo $baseurl;?>/images/logo.png" alt="" ></a>
    
               <?php if($userid=="")
				   {?> 
                   
                    <div class="show-reg-form modal-open"><a class="btn-home" href="#" data-toggle="modal" data-target="#reg">Sign In</a></div>
                    <?php } else{?>
                    
                    <div class="header-user-menu"> 
                        <div class="header-user-name">
                           Welcome <?php echo $firstname;?>
                        </div>
                        <ul>
                         
                            <li><a href="<?php echo $baseurl;?>/log-out">Log Out</a></li>
                        </ul>
                    </div>

                    <?php }?>
  </div>
  