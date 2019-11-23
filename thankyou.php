<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");



?>






<!DOCTYPE HTML>
<html lang="en">
<head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Boshall</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <style>
			.form_p {
    height: 800px;
    margin-top: 15%;
}
.form_p img {
/*	width: 300px;*/
	display: block;
	margin: auto
}
.thankyou {
    box-shadow: 0 0 10px #e1dfdf;
    background: #ffffff;
    border-radius: 10px;
    margin: 50px;
    padding: 30px 0;
}
.form_p.thanku-page {
    margin-top: 80px;
    background: #f3f3f3;
}
.form_p.thanku-page button.home {
    background: #54bbfe;
    border: none;
    padding: 8px 20px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 2px;
    margin-top: 10px;
    letter-spacing: 1px;
}            
            
            .form_p h5{font-size: 22px}
            .form_p p{font-size: 18px} 


		</style>
        <!--=============== css  ===============-->
       <?php include_once("header-all-pages.php");?>
            <!--  header end -->
            
      <div class="form_p thanku-page">
      	<div class="container">
      		<div class="row">
      		<div class="col-md-2"></div>
      			<div class="col-md-8">
                     <div class="thankyou">
<!--
                     <img src="<?php //echo $baseurl;?>/images/click.png" style="width: 80px;padding-top: 40px;">   
                      <img src="<?php //echo $baseurl;?>/images/thankyou.png">   
-->
                <img src="images/check.png" width="70" alt="">
                <h5>Thank you for your enquiry</h5>
                <p>We will get back to you shortly</p>
               <a href="<?php echo $baseurl;?>"> <button class="home default-blue">Back to home</button></a>
                
                
					</div>
                  </div>
                 <div class="col-md-2"></div>
      		</div>
      	</div>
      </div>
         <!--footer -->
      <script type="text/javascript" src="<?php echo $baseurl;?>/javascript/api.js"></script>
        <?php include_once("footer.php");?>                 
