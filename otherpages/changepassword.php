<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$password=md5($_POST['password']);
 $uid=$_POST['uid'];

 $selQry=mysqli_query($conn,"update `register` set `password`='$password' where `id` = '$uid' and `status` = '1' and `view`='1'");

 if($selQry){
	 $execQry=mysqli_fetch_row($selQry);
   	 $uid=$execQry[0];
  
$arr = array('status' =>1);
	}	
	else{
		$arr = array('status' =>2);
		}

header('Content-type: application/json');

		echo json_encode($arr);    
?>