<?php
ini_set('max_execution_time', 0);
ini_set("display_errors", 1);
include_once('db.php');
include_once('config_fetch_api.php');
date_default_timezone_set('America/New_York');


$system = $rets->GetSystemMetadata();
$resources = $system->getResources('RESI');
$classes = $resources->first()->getClasses();
/*echo"<pre>";
print_r($resources->first()->getClasses());
echo"</pre>";*/
$classes = $rets->GetClassesMetadata('RESI');
echo"<pre>";
//print_r($classes);
echo"</pre>";
try
{
	$objects = $rets->GetObject("RESI", "Photo", '72552551', "*", 1);
	echo"<pre>";
    print_r($objects);
    echo"</pre>";
    /*foreach ($objects  as $photourl) {
    		echo $image_url=$photourl->getLocation();
    }*/
}
catch (\Exception $e) {
  echo "error";
}

$fields = $rets->GetTableMetadata('RESI', 'SF');
echo"<pre>";
//print_r($fields);
echo"</pre>";

$results = $rets->Search('RESI', 'SF', 'StandardStatus=ACT',['Limit' => 1]);

$b=$results->toJSON();

$var = json_decode($b,true);

echo '<pre>';
//print_r($var);
echo '</pre>';


/*table code start*/

foreach ($results as $r) {



    //print_r($r["ListingId"]);

echo '<pre>';
//print_r($r);
echo '</pre>';

$results2= $rets->Search('RESI', 'SF', 'ListingId='.$r["ListingId"].'');
$b=$results2->toJSON();

$var = json_decode($b,true);

echo '<pre>';
//print_r($var);
echo '</pre>';
}
$results = $rets->Search('RESI', 'SF', 'ListingId=72533826',['Limit' => 1]);
//$results = $rets->Search('OH', 'OH', 'ListingId=72562514',['Limit' => 1]);
//$results = $rets->Search('RESI', 'MF', 'ZIP_CODE_4=02132',['Limit' => 100000]);

echo count($results);
foreach ($results as $r) {
	echo"<pre>";
	//print_r($r);
	echo"</pre>";
	//echo $r["ZIP_CODE_4"]."=>".$r["StandardStatus"]."<br>";

/*echo "INSERT INTO `temp_mlspindata_master`(`PropertyType`, `ListingId`, `CountyOrParish`, `StateOrProvince`, `StreetName`, `StreetNumber`, `ZIP_CODE_4`, `YearBuilt`, `TaxYear`, `TaxAssessedValue`, `SubdivisionName`, `ListPrice`, `LotSizeSquareFeet`, `LotSizeAcres`, `LivingArea`, `LOT_DESCRIPTION`, `InteriorFeatures`, `LENDER_OWNED`, `ArchitecturalStyle`, `Flooring`, `Appliances`, `EXTERIOR`, `ConstructionMaterials`, `COLOR`, `Roof`, `BedroomsTotal`, `BathroomsFull`, `BathroomsHalf`, `RoomsTotal`, `MASTER_BATH`, `MBR_LEVEL`, `MBR_DSCRP`, `MBR_DIMEN`, `BED2_DIMEN`, `BED2_DSCRP`, `BED2_LEVEL`, `BED3_DIMEN`, `BED3_DSCRP`, `BED3_LEVEL`, `BED4_DIMEN`, `BED4_DSCRP`, `BED4_LEVEL`, `BED5_DIMEN`, `BED5_DSCRP`, `BED5_LEVEL`, `BTH1_DIMEN`, `BTH1_DSCRP`, `BTH1_LEVEL`, `BTH2_DIMEN`, `BTH2_DSCRP`, `BTH2_LEVEL`, `BTH3_DIMEN`, `BTH3_DSCRP`, `BTH3_LEVEL`, `Heating`, `HEAT_ZONES`, `Cooling`, `COOLING_ZONES`, `Electric`, `RoadFrontageType`, `GarageSpaces`, `GARAGE_PARKING`, `ParkingFeatures`, `OpenParkingSpaces`, `Basement`, `BasementYN`, `WaterSource`, `WaterfrontYN`, `SEWER_AND_WATER`, `HOT_WATER`, `WATERVIEW_FEATURES`, `WATERFRONT`, `SeniorCommunityYN`, `PublicRemarks`, `SHORT_SALE_LENDER_APP_REQD`, `pdate`, `City`,`Latitude`,`Longitude` ,`hometype` ,`list_date`, `OH_FLAG`,`Address`) VALUES ('".$r["PropertyType"]."', '".$r["ListingId"]."', '".$r["CountyOrParish"]."', '".$r["StateOrProvince"]."', '".$r["StreetName"]."', '".$r["StreetNumber"]."', '0".$r["ZIP_CODE_4"]."', '".$r["YearBuilt"]."', '".$r["TaxYear"]."', '".$r["TaxAssessedValue"]."', '".$r["SubdivisionName"]."', '".$r["ListPrice"]."', '".$r["LotSizeSquareFeet"]."', '".$r["LotSizeAcres"]."', '".$r["LivingArea"]."', '".$r["LOT_DESCRIPTION"]."', '".$r["InteriorFeatures"]."', '".$r["LENDER_OWNED"]."', '".$r["ArchitecturalStyle"]."', '".$r["Flooring"]."', '".$r["Appliances"]."', '".$r["EXTERIOR"]."', '".$r["ConstructionMaterials"]."', '".$r["COLOR"]."', '".$r["Roof"]."', '".$r["BedroomsTotal"]."', '".$r["BathroomsFull"]."', '".$r["BathroomsHalf"]."', '".$r["RoomsTotal"]."', '".$r["MASTER_BATH"]."', '".$r["MBR_LEVEL"]."', '".$r["MBR_DSCRP"]."', '".$r["MBR_DIMEN"]."', '".$r["BED2_DIMEN"]."', '".$r["BED2_DSCRP"]."', '".$r["BED2_LEVEL"]."', '".$r["BED3_DIMEN"]."', '".$r["BED3_DSCRP"]."', '".$r["BED3_LEVEL"]."', '".$r["BED4_DIMEN"]."', '".$r["BED4_DSCRP"]."', '".$r["BED4_LEVEL"]."', '".$r["BED5_DIMEN"]."', '".$r["BED5_DSCRP"]."', '".$r["BED5_LEVEL"]."', '".$r["BTH1_DIMEN"]."', '".$r["BTH1_DSCRP"]."', '".$r["BTH1_LEVEL"]."', '".$r["BTH2_DIMEN"]."', '".$r["BTH2_DSCRP"]."', '".$r["BTH2_LEVEL"]."', '".$r["BTH3_DIMEN"]."', '".$r["BTH3_DSCRP"]."', '".$r["BTH3_LEVEL"]."', '".$r["Heating"]."', '".$r["HEAT_ZONES"]."', '".$r["Cooling"]."', '".$r["COOLING_ZONES"]."', '".$r["Electric"]."', '".$r["RoadFrontageType"]."', '".$r["GarageSpaces"]."', '".$r["GARAGE_PARKING"]."', '".$r["ParkingFeatures"]."', '".$r["OpenParkingSpaces"]."', '".$r["Basement"]."', '".$r["BasementYN"]."', '".$r["WaterSource"]."', '".$r["WaterfrontYN"]."', '".$r["SEWER_AND_WATER"]."', '".$r["HOT_WATER"]."', '".$r["WATERVIEW_FEATURES"]."', '".$r["WATERFRONT"]."', '".$r["SeniorCommunityYN"]."', '".$r["PublicRemarks"]."', '".$r["SHORT_SALE_LENDER_APP_REQD"]."','$pdate','".$r["City"]."','".$r["Latitude"]."','".$r["Longitude"]."','1','".$r["list_date"]."','".$r["OH_FLAG"]."','".$address."')";*/
}


?>