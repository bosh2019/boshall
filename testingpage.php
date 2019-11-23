<?php /*?><?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");


	
	




$query=mysqli_query($conn,"SELECT * FROM `mlspindata_master`");
 $numrows=mysqli_num_rows($query);
while($resultset=mysqli_fetch_array($query))
{
		$id=$resultset['id'];

	echo "<br>";
	if($resultset['ZIP_CODE_4']!='')
	{
			$newzip="0".$resultset['ZIP_CODE_4'];;

	}
	
	else
	{$newzip=""; 
		
		
	}
	
	echo "update `mlspindata_master` set `ZIP_CODE_4`='$newzip' where `id`='$id'";
	$upquery=mysqli_query($conn,"update `mlspindata_master` set `ZIP_CODE_4`='$newzip' where `id`='$id'");

	
	
	
}?><?php */?>

<?php

$current_date=date("y-m-d");
echo $days_ago = date('Y-m-d', strtotime('-3 days', strtotime($current_date)));


include_once("configuration/connect.php");
include_once("configuration/functions.php");
$to="sakshi@dkd.co.in";
$from="";
$fromname="";
$subject="Inquiry";
$msg="helllo";
sendBasicMail($to,$from,$fromname,$subject,$msg)

?>