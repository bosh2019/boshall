<?php
ob_start();
session_start();
$userid=$_SESSION['id'];

include_once("configuration/connect.php");
include_once("configuration/functions.php");
$myuserDetails=GetRegisterationDetails($conn,$userid);
if($_SERVER['REQUEST_METHOD']=="POST")
{
	
	extract($_POST);
	$hiddendate;
	
}
if(isset($_GET['id']))
{
	$Uid=base64_decode($_GET['id']);

//print_r($property_arr); die;
}

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
        <!--=============== css  ===============-->
       <?php include_once("header-all-pages.php");?>
            <!--  header end -->
        <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 300px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
			.form_p {
    padding-top: 84px;
}
			.heading
			{
				margin-top: 40px;
			}
			.heading h4 {
    font-size: 22px;
   text-align: center;
}
			.form_R h4 {
    font-size: 14px;
}
			.form_R {
    text-align: left;
    font-size: 13px;
				padding-left: 18px;
}
			.heading p {
    text-align: center;
    margin-bottom: 10px;
}
			.custom-form
			{
				 margin-top:15px;
				margin-bottom: 40px
			}
		.btn.color-bg:hover {
    background: #2F3B59;
    color: #fff;
}	
    </style>    
      <div class="form_p">
      	<div class="container">
      		<div class="row">
      		<div class="col-md-2"></div>
      			<div class="col-md-8">
                      <form method="post" id="change_password">
                                <input type="hidden" placeholder="" value="<?php echo $Uid;?>" name="hiddenUserid" id="hiddenUserid">

                        <div class="row">
                         <div class="profile-edit-container">
                                            <div class="heading">
                                                <h4>Change password</h4>
                                            </div>
                                                                    <div id="fmsg"></div>                 
 
                       <div class="custom-form" style="padding: 24px;background: #f5f7fe;">
                            <div class="col-md-6">
                             <label>New Password <i class="fa fa-user-o"></i></label>
                                <input type="password" placeholder="" value="" name="c_password" id="c_password">
                             
						   </div>
                            <div class="col-md-6">
                             <label>Confirm Password <i class="fa fa-user-o"></i></label>	
                             <input type="password" placeholder="" value="" id="cc_password" name="cc_password">
                               
						   </div>
                                
                                       
                                                
                                            
                                 
                                    
                              
						    
						     <div class="col-md-6">
						   <button type="submit" class="btn  big-btn  color-bg flat-btn" id="formnextbtn">Next<i class="fa fa-angle-right"></i></button>
						   </div>
							 </div>
							
							</div>
						  </div>
					</form>   
                  </div>
                 <div class="col-md-2"></div>
      		</div>
      	</div>
      </div>
         <!--footer -->
      <script type="text/javascript" src="<?php echo $baseurl;?>/javascript/api.js"></script>
        <?php include_once("footer.php");?>                 
