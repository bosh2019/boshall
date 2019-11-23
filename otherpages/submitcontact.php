<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
 $fullname=$_POST['fullname'];
 $email=$_POST['email'];
 $subject=$_POST['subject'];
 $phone=$_POST['phone'];
 $message=$_POST['message'];
 $pdate=date("Y-m-d");

		 
 $insqry=mysqli_query($conn,"INSERT INTO `contactus`(`name`, `email`, `subject`, `phone`, `message`, `pdate`, `status`) VALUES ('$fullname','$email','$subject','$phone','$message','$pdate','1')") ;
	if($insqry){
		
			$admsg="New contact-us query submitted";
	addnotice($conn,$admsg); 
	$arr = array('status' =>1);
	}
	else
	{
		$arr = array('status' =>0);
	 
		}
		
		
	
 
header('Content-type: application/json');

		echo json_encode($arr); 
?>
