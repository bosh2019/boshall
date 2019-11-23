<?php
 ob_start();
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
  $id=$_GET['id'];?>
  
  <?php  if($id=='0'){?>
 <div class="panel-heading">Property - All</div>
    
                <div class="panel-body" >
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Name</th>
                        <th align="center">Gallery</th>
                         <th align="center">Add Images</th>
                      
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"select * from `property`  order by `id` ASC ");
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
                      
                        <td><?php echo $fetch['name']?></td>
                         <td class="center"><a href="viewgallery.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-primary"><i class="icon icon-left mdi mdi-eye"> View</i></button> </a></td>
                          <td class="center"><a href="addimages.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-primary"><i class="icon icon-left mdi mdi-image"> Add</i></button> </a></td>
                        

		<td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','property',14)" <?php if($fetch['status']==1){echo 'checked';} ?>>
       <label for="check<?php echo $fetch['id']  ?>" id="status<?php echo $fetch['id']  ?>"><?php echo getStatus($conn,$fetch['status']);  ?></label>
         <div id="status<?php echo $fetch['id']  ?>" ></div></div>
         </td>
                                            
                      </tr>
                      <?php }}else{?>
                      <tr class="even gradeC">
                        <td colspan="5">No records</td>
                         
                      </tr>
                      <?php }?>
                  </tbody>
                  </table>
                </div>
               
              </div>
              
              <?php }else{?>
			  
               <div class="panel-heading">Property - <?php echo getpropertyforamebyid($conn,$id)?> </div>
    
                <div class="panel-body" >
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Name</th>
                        <th align="center">Gallery</th>
                         <th align="center">Add Images</th>
                      
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"select * from `property` where `propertyfor`='$id' order by `id` ASC ");
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
                      
                        <td><?php echo $fetch['name']?></td>
                         <td class="center"><a href="viewgallery.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-primary"><i class="icon icon-left mdi mdi-eye"> View</i></button> </a></td>
                          <td class="center"><a href="addimages.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-primary"><i class="icon icon-left mdi mdi-image"> Add</i></button> </a></td>
                        

		<td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','property',14)" <?php if($fetch['status']==1){echo 'checked';} ?>>
       <label for="check<?php echo $fetch['id']  ?>" id="status<?php echo $fetch['id']  ?>"><?php echo getStatus($conn,$fetch['status']);  ?></label>
         <div id="status<?php echo $fetch['id']  ?>" ></div></div>
         </td>
                                            
                      </tr>
                      <?php }}else{?>
                      <tr class="even gradeC">
                        <td colspan="5">No records</td>
                         
                      </tr>
                      <?php }?>
                  </tbody>
                  </table>
                </div>
               
              </div>
              <?php }?>