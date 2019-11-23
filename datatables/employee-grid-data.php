<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");

	



/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'PropertyType', 
	1 => 'ListingId',
	2=> 'CountyOrParish',
	3=> 'Action'
);

// getting total number records without any search
$sql = "SELECT PropertyType, ListingId, CountyOrParish ";
$sql.=" FROM mlspindata_master";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT PropertyType, ListingId, CountyOrParish ";
$sql.=" FROM mlspindata_master";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" WHERE ( PropertyType LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR ListingId LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR CountyOrParish LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

//echo $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

$id=base64_encode($row['id']);
	$nestedData[] = $row["PropertyType"];
	$nestedData[] = $row["ListingId"];
	$nestedData[] = $row["CountyOrParish"];
	$nestedData[] = '<a href="'.$baseurl.'/admin/viewproperty.php?id='.$id.'">  <button = class="btn btn-rounded btn-space btn-primary"><i class="icon icon-left mdi mdi-eye"> View</i></button> </a>';

	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
