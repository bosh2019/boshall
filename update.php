<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");



$query=mysqli_query($conn,"select * from `pricerange`");
while($result=mysqli_fetch_array($query))
{
	
	$id=$result['id'];
	$amount=trim($result['amount']); 
		$value=trim($result['value']); 

	$up=mysqli_query($conn,"update `pricerange` set `amount`='$amount',`value`='$value' where `id`='$id'");
	
	  
	
	
	
}?>