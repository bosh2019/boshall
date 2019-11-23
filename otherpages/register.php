<?php 
ob_start();		
session_start();
error_reporting(1);
header('Content-Type: application/json');
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(!empty($_POST['uemail']) && !empty($_POST['upassword'])):
		$json = array();
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['uemail'];
		$password=md5($_POST['upassword']);
		$date = date('Y-m-d h:i A');

		$query=mysqli_query($conn,"select `email` from `register` where `email`='$email'");
		$numRows=mysqli_num_rows($query);
	if($numRows > 0)
	{
		$json['status'] = false;
		$json['error'] = "Email already registered.Please choose another one.";
	} 
	else
	{
       $selQry=mysqli_query($conn,"INSERT INTO `register`(`fname`, `lname`, `email`, `password`,`view`, `status`,`added_date`) VALUES ('$fname','$lname','$email','$password','1','1','$date')");

		    if($selQry)
		    {
				 $lastid=mysqli_insert_id($conn);
				 $querys=mysqli_query($conn,"select * from `register` where `id`='$lastid'");
				 $execQry=mysqli_fetch_row($querys);  
			   	 $uid=$execQry[0]; 
			     $_SESSION['id']=$uid;
			     $to_array = ['admin'=>'jwangyz@gmail.com','user'=>$email];
                 $subject_admin = "New User Register";
                 $subject_user = "Thanks for registering with us!";
                 //Admin Message========================
                     $message_admin = "Dear Admin,<br />";
	                 $message_admin.= "New user is registered on website. Please find the details below:<br />";
	                 $message_admin.= "Name: ".$fname." ".$lname."<br />";
	                 $message_admin.= "Email: ".$email."<br />"; 
                  //Admin Message========================

	              //User Message========================
	                 $message_user = "Dear ".$fname." ".$lname.",<br />";
	                 $message_user.= "Thanks for registering with us.<br />";
	                 $message_user.= "<br />";
	                 $message_user.= "<br />";
	                 $message_user.= "Thanks & Regards,<br />";
	                 $message_user.= "Boshall"; 
                  //User Message========================
                     sendregisteremail($to_array['admin'],$subject_admin,$message_admin);
                     sendregisteremail($to_array['user'],$subject_user,$message_user);

			     $json['status'] = true;
			     $json['success'] = "Registered Successfully";
			}	
			else
			{
				$json['status'] = false;
				$json['error'] = "Please try again!";
			}
	}

else:
	$json['status'] = false;
	$json['error'] = "test2";
endif; 
echo json_encode($json); 
?>
