<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

 $enquiryemail=$_POST['enquiryemail'];
	$pdate=date("Y-m-d");
	 
	 $updatequery=mysqli_query($conn,"INSERT INTO `enquiry`(`email`, `pdate`, `status`) VALUES ('$enquiryemail','$pdate','1')");
	 if($updatequery)
	 {
		 
		 $email_from='New Selling Enquiry ';
         $to="jwangyz@gmail.com";
//$to="sakshi@dkd.co.in";

$subject="New Selling Enquiry";
$from="";
$fromname="";
$message="New selling enquiry is received from email id $enquiryemail";
sendBasicMail($to,$from,$fromname,$subject,$message);
$arr = array('status' =>1);
	 }
	 
	 else
	 {
		$arr = array('status' =>0);
 
		 
	 }
	
header('Content-type: application/json');

		echo json_encode($arr); 
?>
