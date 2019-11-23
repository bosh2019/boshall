<?php
ini_set('max_execution_time', 0);
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

$propert_type=array("SF","MF","CC","LD","CI","BU","RN","MH");


$results = $rets->Search('RESI','MH', 'StandardStatus=ACT',['Limit' => 100000]); 

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

	$pdate=date('Y-m-d');
$r["City"]=$conn->real_escape_string($r["City"]);
$r["Latitude"]=$conn->real_escape_string($r["Latitude"]);
$r["Longitude"]=$conn->real_escape_string($r["Longitude"]); 
$r["ListingId"]=$conn->real_escape_string($r["ListingId"]);


   echo $sql="UPDATE  `mlspindata_master` SET `City`='".$r["City"]."',`Latitude`='".$r["Latitude"]."',`Longitude`='".$r["Longitude"]."' where `ListingId`='".$r["ListingId"]."'"; 

    $insertQ=$conn->query($sql); 

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
			echo"<th>Update</th>";
			echo"</tr>";
	    }
	    else
	    {
	    	echo $r["ListingId"]."  =>  Not Updated<br>"; 
	    }
	}/*end if*/
}




?>