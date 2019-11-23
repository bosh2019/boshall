<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$userid=$_SESSION['id'];

$pdate=date("Y-m-d");
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];
 $phone=$_POST['phone'];
 $email=$_POST['email'];
$propertyid=$_POST['listid'];
$usernotes=$_POST['usernotes'];	
$sel=mysqli_query($conn,"INSERT INTO `sell`( `fname`, `lname`, `email`, `phone`, `realstate`, `pdate`, `bookdate`, `booktime`,notes`) VALUES ('$fname','$lname','$email','$phone','$realstate','$pdate','$bookdate','$booktime','$usernotes')");

if($sel)
{
	$notice_msg="New selling inquiry is received by  ".$fname;
	$notice_query=mysqli_query($conn,"INSERT INTO `notices`(`notice`, `pdate`, `visible`) VALUES ('$notice_msg','$pdate','0')");
	if($notice_query)
	{
$arr=array("status"=>1);	
	}
	
	else
	{
	$arr=array("status"=>0);	
	
		
	}
}


else
{
$arr=array("status"=>0);	
	
	
	
	
}
  
  header('Content-type: application/json');

		echo json_encode($arr); 

?>