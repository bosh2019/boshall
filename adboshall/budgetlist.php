<?php  
ob_start();
include_once("../configuration/connect.php");
$countyid=base64_decode($_GET['id']);
function getpropertyforamebyid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `propertyfor` where `id` ='$id'"));

	return $fetchRes[0];
}

$counname=getpropertyforamebyid($conn,$countyid);
header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=Budget-PropertyFor '$counname'_Reoprt.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  
    

    
	?>
 
    
	
	
    <div class="widget-content">
								<table  border="1"class="table table-striped table-bordered table-hover   datatable">
									 <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Budget</th>
                         <th>Property For</th>
                       
                      
                      </tr>
                    </thead>
									<tbody>
									 <?php 
  	$sqlQry=mysqli_query($conn,"select * from `budget` where `status`='1' and `cid`='$countyid'  order by `id` ASC ");
	$i=0;
	$numrows=mysqli_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysqli_fetch_array($sqlQry)){
	$i++;
	if($i%2==0)
	{$class='odd gradeX';
		}
	else{
		$class='even gradeC';
		}
	
  ?> 
   <tr bgcolor="#FFFFFF" id="recordsArray_<?php echo $fetch['id']; ?>" onMouseOver="this.style.cursor='move'">
  
    
   <td class="center"><?= $i?></td>
                      
                        <td><?php echo $fetch['name']?></td>
                               <td><?php echo getpropertyforamebyid($conn,$countyid)?></td>
                         
                        
    </tr>
 <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
  									
									</tbody>
								</table>
							</div>