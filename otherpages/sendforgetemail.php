<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
 $username=$_POST['username'];

 $selQry=mysqli_query($conn,"select * from `register` where `email` = '$username' and `status` = '1' and `view`='1' ");
  $numRows=mysqli_num_rows($selQry);

 if($numRows>0){
	 $execQry=mysqli_fetch_row($selQry);
   	 $uid=$execQry[0];
	 
	$txt = activationText($username,$uid,$baseurl);
    $subject = "Forgot Password Link";
    sendregisteremail($username,$subject,$txt);

	 
	 
$arr = array('status' =>1);
	}	
	else{
		$arr = array('status' =>2);
		}

header('Content-type: application/json');

		echo json_encode($arr);    
?>