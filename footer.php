<?php
include_once("configuration/connect.php");
include_once("configuration/functions.php");
 $execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `social` where `id`='1'"));
?>                   
 <footer class="main-footer ">
                      <input type="hidden" id="actual_urlforlogin" name="actual_urlforlogin" value="<?php echo $actual_urlforlogin;?>">
                        <input type="hidden" id="redirection_val" name="redirection_val" value="<?php echo $redirection_val;?>">

              
                <div class="sub-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="about-widget">
                                    <img src="<?php echo $baseurl;?>/images/logo.png" alt="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="copyright"> &#169; Boshall 2019 .  All rights reserved. </div> <br>
                                <small style="    color: #ccc;margin-top: 9px;display: block;
    font-size: 11px;">Developed by: <a href="https://www.doubleklickdesigns.com/" target="_blank" style="color:#ccc">DoubleKlick Designs</a> </small>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="footer-social">
                                    <ul>
                                        <li><a href="<?php echo $execQry[1];?>" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="<?php echo $execQry[2];?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--footer end  -->
            <!--register form -->
            

            
              
             
            <!--register form end -->
            <a class="to-top"><i class="fa fa-angle-up"></i></a> 
        </div>
        
       

<div id="reg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <!--<div class="modal-header">
      
        <h4 class="modal-title"> Sign In <span>Bos<strong>Hall</strong></span></h4>
      </div>-->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body"> 
       <div id="tabs-container">
                            <ul class="tabs-menu">
                                <li class="current"><a href="#tab-1">Login</a></li>
                                <li><a href="#tab-2">Register</a></li>
                            </ul>
                            <div class="tab">
                                <div id="tab-1" class="tab-content">
                                    <div class="custom-form">
                                        <form method="post"  name="loginform_" id="loginform_">
                                            <label>Email Address *  <i class="fa fa-envelope-o"></i></label>
                                            <input name="email" type="text"   onClick="this.select()" value="" id="email">
                                            <label >Password * <i class="fa fa-eye" ></i></label>
                                            <input name="password" type="password"   onClick="this.select()" value="" id="password" > 
                                             <div class="col-sm-12 text-center" style="clear: both;">
                                             <input type="submit"  class="log-submit-btn" value="Log In" > </div>
                                         
                                            
                                        </form>
                                        <div class="lost_password">
                                            <a href="javascript:void(0)" onclick="forgetmodal()">Lost Your Password?</a>
                                        </div>
                                    </div> 
                                </div>
                                <div class="tab">
                                    <div id="tab-2" class="tab-content">
                                        <div class="custom-form">
                                          <div id="error_msg"></div>
                         <form method="post"   name="registerform" class="main-register-form row" id="registerform">
                                               <div class="col-sm-12">
                                                <label >First Name * <i class="fa fa-user-o"></i></label>
                                                <input name="fname" type="text" id="fname"   onClick="this.select()" value="">
                                                </div>
                                                
                                               <div class="col-sm-12">
                                                <label>Last Name * <i class="fa fa-user-o"></i></label>
                                                <input name="lname" type="text" id="lname"  onClick="this.select()" value="">
                                                </div>
                                                
                                              <div class="col-sm-12">  <label>Email Address * <i class="fa fa-envelope-o"></i></label>
                                                <input name="uemail" type="text" id="uemail"  onClick="this.select()" value=""></div>
                                                
                                                <div class="col-sm-12"><label >Password * <i class="fa fa-eye" ></i></label>
                                                <input name="upassword" type="password" id="upassword"   onClick="this.select()" value="" ></div>
                                                
                                               <div class="col-sm-12 text-center" style="clear: both;"> <button type="submit"     class="log-submit-btn" id="registration_btn" ><span>Register</span></button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
      </div>
      
    </div>

  </div>
</div>



<div id="forget_form" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Forgot Password ?</h4>
      </div>
      <div class="modal-body"> 
       <div id="forgot-passs">
                            
                            <div class="tab">
                                <div class="">
                                    <div class="custom-form">
                                        <form method="post"  name="forgetform_" id="forgetform_">
                                        <div id="fmsg"></div>
                                            <label>Email Address *  <i class="fa fa-envelope-o"></i></label>
                                            <input name="feemail" type="text"   onClick="this.select()" value="" id="feemail">
                                            
                                            <div class="col-sm-12 text-center" style="clear: both;"><input type="submit"  class="log-submit-btn" value="Send"></div>
                                          
                                        </form>
                                        <!--<div class="lost_password">
                                            <a href="#">Lost Your Password?</a>
                                        </div>-->
                                    </div> 
                                </div> 
                                
                            </div>
                        </div>
      </div>
      
    </div>

  </div>
</div>
<!-- Modal -->
<div id="messagepopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="redirect_to()">&times;</button>
        <h4 class="modal-title">Thank You</h4>
      </div>
      <div class="modal-body">
        <p style="color:#0C0">You are registered successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="redirect_to()">Close</button>
      </div>
    </div>

  </div>
</div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->     
      


        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>                      
<script type="text/javascript" src="<?php echo $baseurl;?>/js/jquery-2.1.3.min.js"></script>
 <script type="text/javascript" src="<?php echo $baseurl;?>/javascript/scripts.js"></script>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>

/*$(function() {
   $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
      $(".box-widget-wrap").addClass("sidebar");
    } else {
     $(".box-widget-wrap").removeClass("sidebar");
    }
  });
});*/

$("#carousel").owlCarousel({
  autoplay: false,
  lazyLoad: true,
  loop: true,
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },

    1366: {
      items: 3
    }
  }
});



</script>
<!-- Latest compiled and minified JavaScript -->
     <script type="text/javascript" src="<?php echo $baseurl;?>/js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <script type="text/javascript" src="<?php echo $baseurl;?>/js/jquery.validate.js"></script>
        
        <script type="text/javascript" src="<?php echo $baseurl;?>/js/plugins.js"></script>
        <script type="text/javascript" src="<?php echo $baseurl;?>/js/scripts.js"></script>
      
        <script type="text/javascript" src="<?php echo $baseurl;?>/dist/notie.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>-->

    <script>
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
});
</script>
 
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5da5bd8511f2900bf44737de/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 200) {
        $(".filter-section").addClass("top-fix");
    } else {
        $(".filter-section").removeClass("top-fix");
    }
});
</script>
<!--End of Tawk.to Script-->
