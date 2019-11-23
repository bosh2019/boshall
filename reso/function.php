<?php

function checkListingIdByListingId($conn,$listingid)
{
	$sql="SELECT * FROM `mlspindata_master` WHERE `ListingId`='$listingid'";

	$result=$conn->query($sql);
	
}

?>