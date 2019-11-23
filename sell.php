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
	$listid=$_GET['id'];
$property_arr=getpropertDetailsFromListId($conn,$listid);

$latitude=$property_arr['Latitude'];
$longitude=$property_arr['Longitude']; 
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
       <?php include_once("header.php");?>
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
                      <form method="post" id="sellingform">

                        <div class="row">                 
                         <div class="profile-edit-container">
                                            <div class="heading">
                                                <h4>Talk to local agent</h4>
                                                <p>We're here to help seven days a week.</p> 
                                            </div>
                       <div class="custom-form" style="padding: 24px;background: #f5f7fe;">
                            <div class="col-md-6">
                             <label>First Name <i class="fa fa-user-o"></i></label>
                                <input type="text" placeholder="" value="<?php echo $myuserDetails['fname'];?>" name="sell_name" id="sellname">
                             
						   </div>
                            <div class="col-md-6">
                             <label>Last Name <i class="fa fa-user-o"></i></label>	
                             <input type="text" placeholder="" value="<?php echo $myuserDetails['lname'];?>" id="sell_lname" name="sell_lname">
                               
						   </div>
                                <div class="col-md-6">
                                  <label>Email Address<i class="fa fa-envelope-o"></i>  </label>
                                 <input type="text" placeholder="" value="<?php echo $myuserDetails['email'];?>" name="sell_email" id="sell_email">
                               
						   </div>
                             <div class="col-md-6">
                             
                            <label>Phone<i class="fa fa-phone"></i>  </label>
                               <input type="text" placeholder="" value=<?php echo $myuserDetails['phone'];?>"" name="sell_phone" id="sell_phone">
						   </div>          
                                                
                                           
                                 
                                    
                            <div class="col-md-12">
                             <label>What can we help you with?</label>
                             <textarea cols="30" rows="3" placeholder="I'm interested in buying, selling or a free consult with a Agent." name="usernotes" id="usernotes"></textarea>     

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
