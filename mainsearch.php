<?php 
ob_start();

session_start();

include_once('configuration/connect.php');

include_once('configuration/functions.php');

$name = trim(strip_tags($_GET['term']));
 
 if($name!='')
{
$query1=mysqli_query($conn,"SELECT DISTINCT `city` FROM `mlspindata_master` WHERE  `city` like '%$name%' and `view`='1' order by `city`");
	while($professions=mysqli_fetch_array($query1))
	{
		
		
		
		$row['value']=htmlentities(stripslashes($professions['city']));
		$row['type']=1;
		$row_set[] = $row;
		
		
		   
		
	}    
	
	
	 $query3=mysqli_query($conn,"SELECT DISTINCT `PostalCode` FROM `mlspindata_master` WHERE  `PostalCode` like '%$name%' and `view`='1' order by `PostalCode`");
	while($zip=mysqli_fetch_array($query3)) 
	{
		
		
		$row['value']=$zip['PostalCode'];
		$row['type']=2;
		$row_set[] = $row;
	}
	
	$query4=mysqli_query($conn,"SELECT DISTINCT `Address` FROM `mlspindata_master` WHERE  `Address` like '%$name%' and `view`='1' order by `Address`");
	while($address=mysqli_fetch_array($query4))
	{
		
		
		//$row['value']=$address['StreetName'];
		
				$row['value']=$address['Address'];

		$row['id']=(int)$address['id'];
		$row['type']=3;
		$row_set[] = $row;   
	}   

}

else
{
	$query1=mysqli_query($conn,"SELECT DISTINCT `city` FROM `mlspindata_master` WHERE `view`='1'");
	while($professions=mysqli_fetch_array($query1))
	{
		
		
		
		$row['value']=htmlentities(stripslashes($professions['city']));
		$row['type']=1;
		$row_set[] = $row;
		
		
		   
		
	}    
	
	
	
	
	
}
 echo json_encode($row_set);
 
 die;

//$qstring = "SELECT title as value,id FROM books WHERE title LIKE '%".$term."%'";


?>