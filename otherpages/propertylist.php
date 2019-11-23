<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
 $propname=$_POST['propname'];
 $propid=$_POST['propid'];
 $propphone=$_POST['propphone'];
 $propemail=$_POST['propemail'];
 $propmsg=$_POST['propmsg'];
 
$parr=getpropertydetailsbyid($conn,$propid);

 $pdate=date("Y-m-d");

		 
 $insqry=mysqli_query($conn,"INSERT INTO `proenq`(`propname`, `propid`, `propphone`, `propemail`, `propmsg`, `pdate`, `status`) VALUES ('$propname','$propid','$propphone','$propemail','$propmsg','$pdate','1')") ;
	if($insqry){
		
			$admsg="New query submitted for property -'$parr[1]'";
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
