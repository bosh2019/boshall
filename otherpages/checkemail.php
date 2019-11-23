<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$email=$_POST['uemail'];

$query=mysqli_query($conn,"select `email` from `register` where `email`='$email'");
$numRows=mysqli_num_rows($query);
if($numRows > 0)
{
	echo false;
} 
else
{
	echo true;
}  
?>
