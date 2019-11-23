<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$userid=$_SESSION['id'];

 $property_id=$_GET['property_id'];
$pdate=date("Y-m-d");


$sel=mysqli_query($conn,"select * from `property_wishlist` where `userid`='$userid' and `property_id`='$property_id'");

$numrows=mysqli_num_rows($sel);
if($numrows==0)
{
 $selQry=mysqli_query($conn,"INSERT INTO `property_wishlist`(`id`, `userid`, `property_id`, `pdate`) VALUES (NULL,'$userid','$property_id','$pdate')");
 
 	$num='1';

}

else
{
	$resultset=mysqli_fetch_row($sel);
	$id=$resultset[0];
 $selQry=mysqli_query($conn,"delete from `property_wishlist` where `id`='$id'");
	
	$num='0';
	
}

if($selQry)
{
	
	echo $num;
	
	
}
  
  else
  {
	echo '2';  
	  
	  
	  
  }
  
  
  

?>