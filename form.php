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
                      <form method="post" id="bookingform">
                                      <input type="hidden" id="P_listid"  name="P_listid" value="<?php echo $listid;?>">                          

                        <div class="row">                 
                         <div class="profile-edit-container">
                                            <div class="heading">
                                                <h4>Tell Us a little about yourself</h4>
                                                <p>We will never share your information or spam you</p>
                                            </div>
                       <div class="custom-form" style="padding: 24px;background: #f5f7fe;">
                            <div class="col-md-6">
                             <label>First Name <i class="fa fa-user-o"></i></label>
                                <input type="text" placeholder="" value="<?php echo $myuserDetails['fname'];?>" name="bookname" id="bookname">
                             
						   </div>
                            <div class="col-md-6">
                             <label>Last Name <i class="fa fa-user-o"></i></label>	
                             <input type="text" placeholder="" value="<?php echo $myuserDetails['lname'];?>" id="booklname" name="booklname">
                               
						   </div>
                                <div class="col-md-6">
                                  <label>Email Address<i class="fa fa-envelope-o"></i>  </label>
                                 <input type="text" placeholder="" value="<?php echo $myuserDetails['email'];?>" name="bookemail" id="bookemail">
                               
						   </div>
                             <div class="col-md-6">
                             
                            <label>Phone<i class="fa fa-phone"></i>  </label>
                               <input type="text" placeholder="" value=<?php echo $myuserDetails['phone'];?>"" name="bookphone" id="bookphone">
						   </div>          
                                                
                                           
                                 <div class="col-md-12">
                                       <div class="row">
                                        
                                        <div class="form_R">
                                                <h4>Are you currently working with a real estate</h4>
                                            </div>
                                          <div class="custom-form" style="padding-left: 18px;    margin-bottom: 25px;">
                                                <div class="row">
                                                    <!--col --> 
                                                    <div class="col-md-3">
                                                        <div class="">
                                                            <label class="radio inline"> 
                                                            <input type="radio" name="realstate"  value="Yes">
                                                            <span>Yes</span> 
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="">
                                                            <label class="radio inline"> 
                                                            <input type="radio" name="realstate" checked value="No">
                                                            <span>No</span> 
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!--col end--> 
                                                    <!--col --> 
                                                                                               
                                                </div>
                                            </div>
									 </div>
                                      </div>
                                    
                            <div class="col-md-12">
                             <label>Notes: (optional)</label>
                             <textarea cols="30" rows="3" placeholder="Anything else you'd like us to know about this tour or your home search" name="usernotes" id="usernotes"></textarea>                               <input type="hidden" value="<?php echo $hiddendate;?>" name="hiddendate" id="hiddendate">

                              <!--<p style="text-align:left">By continuing you agree to our <span style="color:blue;text-align:left">Terms of Services and Privacy Policy</span></p>-->
						   </div>  
						    <div class="col-md-6">
                         <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>"> <span class="btn  big-btn  color-bg flat-btn" style="margin-top: 30px;"><i class="fa fa-angle-left"></i> &nbsp;Back</span></a>
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
