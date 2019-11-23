<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

 $enquiryemail=$_POST['buyemail'];
 $places=$_POST['places'];
 $buymobile=$_POST['buymobile'];
 $buycontent=mysqli_real_escape_string($_POST['buycontent']);
	$pdate=date("Y-m-d");
	// echo "INSERT INTO `buy_enquiry`(`email`, `pdate`, `status`,`place`,`phone`,`content`) VALUES ('$enquiryemail','$pdate','1','$places','$buymobile','$buycontent')"; die;
	 $updatequery=mysqli_query($conn,"INSERT INTO `buy_enquiry`(`email`, `pdate`, `status`,`place`,`phone`,`content`) VALUES ('$enquiryemail','$pdate','1','$places','$buymobile','$buycontent')");
	 if($updatequery)
	 {
$arr = array('status' =>1);
	 }
	 
	 else
	 {
		$arr = array('status' =>0);
 
		 
	 }
	
header('Content-type: application/json');

		echo json_encode($arr); 
?>
