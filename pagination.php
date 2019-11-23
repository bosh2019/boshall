<?php  

$limit = 10;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = mysqli_query($conn,"SELECT * FROM user_table ORDER BY userid ASC LIMIT $start_from, $limit");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
</head>
<body>
<table class="table table-bordered table-striped">  
<thead>  
<tr>  
<th>userid</th>  
<th>First name</th>
<th>Last name</th>
 <th>City name</th>
<th>email</th> 
</tr>  
<thead>  
<tbody>  


            <tr>  
				<td>TEST</td>  
				<td>TEST</td>
				<td>TEST</td>
				<td>TEST</td>
				<td>TEST</td>			
            </tr>  
  
</tbody>  
</table>  
<?php  


$total_pages="10";
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='pagination.php?page=".$i."'>".$i."</a></li>";	
}
echo $pagLink . "</ul>";  
?>

<?php include_once("footer.php");?>