<?php  
   ob_start();
  include_once("../configuration/connect.php");
  include("../configuration/functions.php");
header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=PropertyQuery_Report.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  
    

    
	?>
 
    
	
	
    <div class="widget-content">
								<table  border="1"class="table table-striped table-bordered table-hover   datatable">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Listing Id </th>
                        <th>First Name</th>
                        <th>Last Name </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Schedule Tour</th>
                        <th>Inquired On</th>
                        
                        
                        
                        
                       
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"SELECT  * FROM `bookings` order by `id` desc ");
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
                      <tr class="<?= $class?> ">
                        <td class="center"><?= $i?></td>
                      <td><?php echo $fetch['propertyid'];?></td>
                      
                       <td><?php echo $fetch['fname'];?></td>      
                         <td><?php echo $fetch['lname'];?></td>
                         <td><?php echo $fetch['email'];?></td>
                           <td><?php echo $fetch['phone'];?></td>                       
                           <td><?php echo changeDateFormat($conn,$fetch['bookdate']);?></td>                        
                            <td><?php echo changeDateFormat($conn,$fetch['pdate']);?></td>             
                                     </tr>
                      <?php }}else{?>
                      <tr class="even gradeC">
                        <td colspan="8">No records</td>
                         
                      </tr>
                      <?php }?>
                  </tbody>
                  </table>
							</div>