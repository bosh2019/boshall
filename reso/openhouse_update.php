<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
ini_set("display_errors", 1);
include_once('db.php');
date_default_timezone_set('America/New_York');
require_once("config_fetch_api.php");
$photourl=array();

$truncateSql1="TRUNCATE TABLE `mlspin_openhouse`";

$resultTrun1=$conn->query($truncateSql1);

if($resultTrun1)
{

$sql="SELECT `ListingId` FROM `mlspindata_master` WHERE `OH_FLAG` LIKE '1' ORDER BY `id` ASC";

$selectQ=$conn->query($sql);
/*table code start*/
echo"<pre>";
echo"<table border='1'>";
echo"<tr>";
echo"<th>S.no.</th>";
echo"<th>Listing Id</th>";
echo"<th>OpenHouseRemarks</th>";
echo"<th>OpenHouseStartTime</th>";
echo"<th>OriginalEntryTimestamp</th>";
echo"<th>ModificationTimestamp</th>";
echo"<th>OpenHouseKey</th>";
echo"</tr>";
$i=1;
/*echo $selectQ->num_rows;
die();*/
if($selectQ->num_rows>0)
{
	while ($row=$selectQ->fetch_assoc()) {

		
        try
			{
				$photourl = $rets->Search('OH', 'OH', 'ListingId='.$row["ListingId"].'',['Limit' => 1]);
				foreach ($photourl as $object) {
							//print_r($object);
							$pdate=date('Y-m-d');
							$sqlinsert="INSERT INTO `mlspin_openhouse`(`ListingId`, `OpenHouseRemarks`, `OpenHouseStartTime`, `OriginalEntryTimestamp`, `ModificationTimestamp`, `OpenHouseKey`, `OpenHouseId`, `OpenHouseType`, `Duration`, `Who`, `PostedDate`) VALUES ('".$row["ListingId"]."','".$object["OpenHouseRemarks"]."','".$object["OpenHouseStartTime"]."','".$object["OriginalEntryTimestamp"]."','".$object["ModificationTimestamp"]."','".$object["OpenHouseKey"]."','".$object["OpenHouseId"]."','".$object["OpenHouseType"]."','".$object["Duration"]."','".$object["Who"]."','$pdate')";
							$insertQ=$conn->query($sqlinsert);
							$insertQ=1;
							if($insertQ)
							{
							echo"<tr>";
							echo"<th>".$i++."</th>";
							echo"<th>".$row["ListingId"]."</th>";
							echo"<th>".$object["OpenHouseRemarks"]."</th>";
							echo"<th>".$object["OpenHouseStartTime"]."</th>";
							echo"<th>".$object["OriginalEntryTimestamp"]."</th>";
							echo"<th>".$object["ModificationTimestamp"]."</th>";
							echo"<th>".$object["OpenHouseKey"]."</th>";
							echo"</tr>";
							}
						}
					
			}
			catch (\Exception $e)
			{
						echo"<tr>";
						echo"<th>".$i++."</th>";
						echo"<th>".$row["id"]."</th>";
						echo"<th>".$row["ListingId"]."</th>";
						echo"<th>Not Available</th>";
						echo"</tr>";
			}
			

	}
}
echo"</table>";
/*$photourl = $rets->Search('OH', 'OH', 'ListingId=72292231',['Limit' => 1]);
				foreach ($photourl as $object) {
							print_r($object);
						}*/




}
?>