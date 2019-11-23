<?php 
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");


	
	




$query=mysqli_query($conn,"SELECT * FROM `mlspindata_master`");
 $numrows=mysqli_num_rows($query);
while($resultset=mysqli_fetch_array($query))
{
		$id=$resultset['id'];

$address=$resultset['StreetNumber']." ".$resultset['StreetName']." ".$resultset['CountyOrParish']." ".$resultset['StateOrProvince'];
	
	echo "update `mlspindata_master` set `	Address`='$address' where `id`='$id'";
	$upquery=mysqli_query($conn,"update `mlspindata_master` set `Address`='$address' where `id`='$id'"); 

	echo "<br>";  
	
}

?>

