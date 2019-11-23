<?php
ini_set('max_execution_time', 0);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); 
include_once('db.php');
date_default_timezone_set('America/New_York');

require_once("vendor/autoload.php");


$config = new \PHRETS\Configuration;
$config->setLoginUrl('https://mlspin-dd.apps.retsiq.com/contact/rets/login')
        ->setUsername('AN2159')
        ->setPassword('vczmxm6')
        ->setRetsVersion('1.8');


// optional.  value shown below are the defaults used when not overridden
//$config->setUserAgent('PHRETS/1.0');
//$config->setUserAgentPassword($rets_user_agent_password); // string password, if given
$config->setHttpAuthenticationMethod('basic'); // or 'basic' if required 
$config->setOption('use_post_method', true); // boolean
$config->setOption('disable_follow_location', true); // boolean

$rets = new \PHRETS\Session($config);

// If you're using Monolog already for logging, you can pass that logging instance to PHRETS for some additional
// insight into what PHRETS is doing.
//
$log = new \Monolog\Logger('PHRETS');
$log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
$rets->setLogger($log);

$connect = $rets->Login();
if ($connect) {
 echo "Connected!<br>";
}
else {
 echo "Not Connected!<br>";
 print_r($rets->Error());
 exit;
}
$system = $rets->GetSystemMetadata();
$resources = $system->getResources('RESI');
$classes = $resources->first()->getClasses();

$results = $rets->Search('RESI', 'RN', 'StandardStatus=ACT',['Limit' => 100000]);

/*table code start*/
echo"<table border='1'>";
echo"<tr>";
echo"<th>S.no.</th>";
echo"<th>State Code</th>";
echo"<th>Listing Id</th>";
echo"<th>Property Type</th>";
echo"<th>Propertytype Code</th>";
echo"<th>Postal Code</th>";
echo"<th>City</th>";
echo"<th>StandardStatus</th>";
echo"<th>Status</th>";
echo"</tr>";
foreach ($results as $r) {

	if($r["StateOrProvince"]=='MA'){
$i=1;
$pdate=date('Y-m-d');
$r["PropertyType"]=$conn->real_escape_string($r["PropertyType"]);
$r["ListingId"]=$conn->real_escape_string($r["ListingId"]);
$r["CountyOrParish"]=$conn->real_escape_string($r["CountyOrParish"]); 
$r["StateOrProvince"]=$conn->real_escape_string($r["StateOrProvince"]);
$r["StreetName"]= $conn->real_escape_string($r["StreetName"]);
$r["StreetNumber"]= $conn->real_escape_string($r["StreetNumber"]);
$r["ZIP_CODE_4"]=$conn->real_escape_string($r["ZIP_CODE_4"]);
$r["YearBuilt"]=$conn->real_escape_string($r["YearBuilt"]);
$r["TaxYear"]=$conn->real_escape_string($r["TaxYear"]);
$r["TaxAssessedValue"]=$conn->real_escape_string($r["TaxAssessedValue"]); 
$r["SubdivisionName"]= $conn->real_escape_string($r["SubdivisionName"]); 
$r["ListPrice"]=$conn->real_escape_string($r["ListPrice"]);
$r["LotSizeSquareFeet"]=$conn->real_escape_string($r["LotSizeSquareFeet"]); 
$r["LotSizeAcres"]= $conn->real_escape_string($r["LotSizeAcres"]);
$r["LivingArea"]= $conn->real_escape_string($r["LivingArea"]);
$r["LOT_DESCRIPTION"]=$conn->real_escape_string($r["LOT_DESCRIPTION"]);
$r["InteriorFeatures"]=$conn->real_escape_string($r["InteriorFeatures"]);
$r["LENDER_OWNED"]= $conn->real_escape_string($r["LENDER_OWNED"]);
$r["ArchitecturalStyle"]=$conn->real_escape_string($r["ArchitecturalStyle"]);
$r["Flooring"]=$conn->real_escape_string($r["Flooring"]);
$r["Appliances"]= $conn->real_escape_string($r["Appliances"]);
$r["EXTERIOR"]= $conn->real_escape_string($r["EXTERIOR"]);
$r["ConstructionMaterials"]=$conn->real_escape_string($r["ConstructionMaterials"]);
$r["COLOR"]= $conn->real_escape_string($r["COLOR"]);
$r["Roof"]= $conn->real_escape_string($r["Roof"]); 
$r["BedroomsTotal"]=$conn->real_escape_string($r["BedroomsTotal"]); 
$r["BathroomsFull"]= $conn->real_escape_string($r["BathroomsFull"]);
$r["BathroomsHalf"]=$conn->real_escape_string($r["BathroomsHalf"]);
$r["RoomsTotal"]=  $conn->real_escape_string($r["RoomsTotal"]);
$r["MASTER_BATH"]=$conn->real_escape_string($r["MASTER_BATH"]);
$r["MBR_LEVEL"]=   $conn->real_escape_string($r["MBR_LEVEL"]); 
$r["MBR_DSCRP"]= $conn->real_escape_string($r["MBR_DSCRP"]);
$r["MBR_DIMEN"]=  $conn->real_escape_string($r["MBR_DIMEN"]); 
$r["BED2_DIMEN"]=$conn->real_escape_string($r["BED2_DIMEN"]);
$r["BED2_DSCRP"]= $conn->real_escape_string($r["BED2_DSCRP"]);
$r["BED2_LEVEL"]= $conn->real_escape_string($r["BED2_LEVEL"]);
$r["BED3_DIMEN"]=$conn->real_escape_string($r["BED3_DIMEN"]);
$r["BED3_DSCRP"]= $conn->real_escape_string($r["BED3_DSCRP"]);
$r["BED3_LEVEL"]= $conn->real_escape_string($r["BED3_LEVEL"]);
$r["BED4_DIMEN"]=$conn->real_escape_string($r["BED4_DIMEN"]);
$r["BED4_DSCRP"]= $conn->real_escape_string($r["BED4_DSCRP"]);
$r["BED4_LEVEL"]= $conn->real_escape_string($r["BED4_LEVEL"]);
$r["BED5_DIMEN"]=$conn->real_escape_string($r["BED5_DIMEN"]);
$r["BED5_DSCRP"]= $conn->real_escape_string($r["BED5_DSCRP"]);
$r["BED5_LEVEL"]= $conn->real_escape_string($r["BED5_LEVEL"]);
$r["BTH1_DIMEN"]=$conn->real_escape_string($r["BTH1_DIMEN"]);
$r["BTH1_DSCRP"]=$conn->real_escape_string($r["BTH1_DSCRP"]); 
$r["BTH1_LEVEL"]= $conn->real_escape_string($r["BTH1_LEVEL"]);
$r["BTH2_DIMEN"]=$conn->real_escape_string($r["BTH2_DIMEN"]);
$r["BTH2_DSCRP"]=$conn->real_escape_string($r["BTH2_DSCRP"]); 
$r["BTH2_LEVEL"]= $conn->real_escape_string($r["BTH2_LEVEL"]);
$r["BTH3_DIMEN"]=$conn->real_escape_string($r["BTH3_DIMEN"]);
$r["BTH3_DSCRP"]=$conn->real_escape_string($r["BTH3_DSCRP"]); 
$r["BTH3_LEVEL"]= $conn->real_escape_string($r["BTH3_LEVEL"]);
$r["Heating"]=$conn->real_escape_string($r["Heating"]);
$r["HEAT_ZONES"]=$conn->real_escape_string($r["HEAT_ZONES"]);
$r["Cooling"]=$conn->real_escape_string($r["Cooling"]);
$r["COOLING_ZONES"]=$conn->real_escape_string($r["COOLING_ZONES"]); 
$r["Electric"]= $conn->real_escape_string($r["Electric"]);
$r["RoadFrontageType"]=$conn->real_escape_string($r["RoadFrontageType"]);
$r["GarageSpaces"]=$conn->real_escape_string($r["GarageSpaces"]);
$r["GARAGE_PARKING"]=$conn->real_escape_string($r["GARAGE_PARKING"]);
$r["ParkingFeatures"]=$conn->real_escape_string($r["ParkingFeatures"]);
$r["OpenParkingSpaces"]=$conn->real_escape_string($r["OpenParkingSpaces"]); 
$r["Basement"]=     $conn->real_escape_string($r["Basement"]);
$r["BasementYN"]= $conn->real_escape_string($r["BasementYN"]);
$r["WaterSource"]= $conn->real_escape_string($r["WaterSource"]); 
$r["WaterfrontYN"]=$conn->real_escape_string($r["WaterfrontYN"]);
$r["SEWER_AND_WATER"]=$conn->real_escape_string($r["SEWER_AND_WATER"]);
$r["HOT_WATER"]= $conn->real_escape_string($r["HOT_WATER"]);
$r["WATERVIEW_FEATURES"]=$conn->real_escape_string($r["WATERVIEW_FEATURES"]); 
$r["WATERFRONT"]= $conn->real_escape_string($r["WATERFRONT"]);
$r["SeniorCommunityYN"]=$conn->real_escape_string($r["SeniorCommunityYN"]); 
$r["PublicRemarks"]=$conn->real_escape_string($r["PublicRemarks"]);
$r["SHORT_SALE_LENDER_APP_REQD"]=$conn->real_escape_string($r["SHORT_SALE_LENDER_APP_REQD"]);
$r["City"]=$conn->real_escape_string($r["City"]);
$r["Latitude"]=$conn->real_escape_string($r["Latitude"]);
$r["Longitude"]=$conn->real_escape_string($r["Longitude"]);
$r["OH_FLAG"]=$conn->real_escape_string($r["OH_FLAG"]);
$r["list_date"]=$conn->real_escape_string($r["ListingContractDate"]);

    //$sql="INSERT INTO `mlspindata_master`(`PropertyType`, `ListingId`, `CountyOrParish`, `StateOrProvince`, `StreetName`, `StreetNumber`, `ZIP_CODE_4`, `YearBuilt`, `TaxYear`, `TaxAssessedValue`, `SubdivisionName`, `ListPrice`, `LotSizeSquareFeet`, `LotSizeAcres`, `LivingArea`, `LOT_DESCRIPTION`, `InteriorFeatures`, `LENDER_OWNED`, `ArchitecturalStyle`, `Flooring`, `Appliances`, `EXTERIOR`, `ConstructionMaterials`, `COLOR`, `Roof`, `BedroomsTotal`, `BathroomsFull`, `BathroomsHalf`, `RoomsTotal`, `MASTER_BATH`, `MBR_LEVEL`, `MBR_DSCRP`, `MBR_DIMEN`, `BED2_DIMEN`, `BED2_DSCRP`, `BED2_LEVEL`, `BED3_DIMEN`, `BED3_DSCRP`, `BED3_LEVEL`, `BED4_DIMEN`, `BED4_DSCRP`, `BED4_LEVEL`, `BED5_DIMEN`, `BED5_DSCRP`, `BED5_LEVEL`, `BTH1_DIMEN`, `BTH1_DSCRP`, `BTH1_LEVEL`, `BTH2_DIMEN`, `BTH2_DSCRP`, `BTH2_LEVEL`, `BTH3_DIMEN`, `BTH3_DSCRP`, `BTH3_LEVEL`, `Heating`, `HEAT_ZONES`, `Cooling`, `COOLING_ZONES`, `Electric`, `RoadFrontageType`, `GarageSpaces`, `GARAGE_PARKING`, `ParkingFeatures`, `OpenParkingSpaces`, `Basement`, `BasementYN`, `WaterSource`, `WaterfrontYN`, `SEWER_AND_WATER`, `HOT_WATER`, `WATERVIEW_FEATURES`, `WATERFRONT`, `SeniorCommunityYN`, `PublicRemarks`, `SHORT_SALE_LENDER_APP_REQD`, `pdate`, `City`,`Latitude`,`Longitude` ,`hometype` ,`list_date`, `OH_FLAG`) VALUES ('".$r["PropertyType"]."', '".$r["ListingId"]."', '".$r["CountyOrParish"]."', '".$r["StateOrProvince"]."', '".$r["StreetName"]."', '".$r["StreetNumber"]."', '".$r["ZIP_CODE_4"]."', '".$r["YearBuilt"]."', '".$r["TaxYear"]."', '".$r["TaxAssessedValue"]."', '".$r["SubdivisionName"]."', '".$r["ListPrice"]."', '".$r["LotSizeSquareFeet"]."', '".$r["LotSizeAcres"]."', '".$r["LivingArea"]."', '".$r["LOT_DESCRIPTION"]."', '".$r["InteriorFeatures"]."', '".$r["LENDER_OWNED"]."', '".$r["ArchitecturalStyle"]."', '".$r["Flooring"]."', '".$r["Appliances"]."', '".$r["EXTERIOR"]."', '".$r["ConstructionMaterials"]."', '".$r["COLOR"]."', '".$r["Roof"]."', '".$r["BedroomsTotal"]."', '".$r["BathroomsFull"]."', '".$r["BathroomsHalf"]."', '".$r["RoomsTotal"]."', '".$r["MASTER_BATH"]."', '".$r["MBR_LEVEL"]."', '".$r["MBR_DSCRP"]."', '".$r["MBR_DIMEN"]."', '".$r["BED2_DIMEN"]."', '".$r["BED2_DSCRP"]."', '".$r["BED2_LEVEL"]."', '".$r["BED3_DIMEN"]."', '".$r["BED3_DSCRP"]."', '".$r["BED3_LEVEL"]."', '".$r["BED4_DIMEN"]."', '".$r["BED4_DSCRP"]."', '".$r["BED4_LEVEL"]."', '".$r["BED5_DIMEN"]."', '".$r["BED5_DSCRP"]."', '".$r["BED5_LEVEL"]."', '".$r["BTH1_DIMEN"]."', '".$r["BTH1_DSCRP"]."', '".$r["BTH1_LEVEL"]."', '".$r["BTH2_DIMEN"]."', '".$r["BTH2_DSCRP"]."', '".$r["BTH2_LEVEL"]."', '".$r["BTH3_DIMEN"]."', '".$r["BTH3_DSCRP"]."', '".$r["BTH3_LEVEL"]."', '".$r["Heating"]."', '".$r["HEAT_ZONES"]."', '".$r["Cooling"]."', '".$r["COOLING_ZONES"]."', '".$r["Electric"]."', '".$r["RoadFrontageType"]."', '".$r["GarageSpaces"]."', '".$r["GARAGE_PARKING"]."', '".$r["ParkingFeatures"]."', '".$r["OpenParkingSpaces"]."', '".$r["Basement"]."', '".$r["BasementYN"]."', '".$r["WaterSource"]."', '".$r["WaterfrontYN"]."', '".$r["SEWER_AND_WATER"]."', '".$r["HOT_WATER"]."', '".$r["WATERVIEW_FEATURES"]."', '".$r["WATERFRONT"]."', '".$r["SeniorCommunityYN"]."', '".$r["PublicRemarks"]."', '".$r["SHORT_SALE_LENDER_APP_REQD"]."','$pdate','".$r["City"]."','".$r["Latitude"]."','".$r["Longitude"]."','1','".$r["list_date"]."','".$r["OH_FLAG"]."')";

    //$insertQ=$conn->query($sql);
	$insertQ=1;
	    if($insertQ)
	    {
			echo"<tr>";
			echo"<th>".$i++."</th>";
			echo"<th>".$r["StateOrProvince"]."</th>";
			echo"<th>".$r["ListingId"]."</th>";
			echo"<th>".$r["PropertyType"]."</th>";
			echo"<th>RN</th>";
			echo"<th>".$r["PostalCode"]."</th>";
			echo"<th>".$r["City"]."</th>";
			echo"<th>".$r["StandardStatus"]."</th>";
			echo"<th>Inserted</th>";
			echo"</tr>";
	    }
	    else
	    {
	    	echo $r["ListingId"]."  =>  Not Inserted<br>";
	    }
	}/*end if*/
}




?>