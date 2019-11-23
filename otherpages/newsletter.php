<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
 $username=$_POST['username'];
 
 $pdate=date("Y-m-d");
//echo "select * from `subscribe` where `email`='$email' ";
 $sqlQry=mysqli_query($conn,"select * from `subscribe` where `email`='$username' ");
 $numRows=mysqli_num_rows($sqlQry);
 if($numRows>0){
	 $arr = array('status' =>0);
	 
	 
	 }
	 
	 else{
		 
		 $insqry=mysqli_query($conn,"INSERT INTO `subscribe` (`email`, `pdate`, `status`) VALUES ('$username', '$pdate', '1');") ;
	if($insqry){
		
			$admsg="Customer with email id". " ".$username." has subscribed";
	addnotice($conn,$admsg); 
	$arr = array('status' =>1);
	}
	else
	{
		$arr = array('status' =>0);
	 
		}
		
		}
	
 
header('Content-type: application/json');

		echo json_encode($arr); 
?>
