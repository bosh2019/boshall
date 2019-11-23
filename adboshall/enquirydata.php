<?php  
   ob_start();
  include_once("../configuration/connect.php");
  include("../configuration/functions.php");
header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=Enquiry_Report.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  
    

    
	?>
 
    
	
	
    
	<table id="table1" class="table table-striped table-hover table-fw-widget" border="1" style="border-collapse: collapse">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Email</th>
                        <th>Inquired On</th>
                        
                        
                        
                        
                       
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"SELECT  * FROM `enquiry` order by `id` desc ");
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
                        <td align="center"><?= $i?></td>
                        <td align="center"><?php echo $fetch['email'];?></td>
                        
                            <td align="center"><?php echo changeDateFormat($conn,$fetch['pdate']);?></td>             
                                     </tr>
                      <?php }}else{?>
                      <tr >
                        <td colspan="3">No records</td>
                         
                      </tr>
                      <?php }?>
                  </tbody>
                  </table>
						