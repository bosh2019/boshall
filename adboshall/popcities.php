<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");
checkIntrusion($conn,$uid);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
     <link rel="shortcut icon" href="assets/img/lttj.png">
    <title>Joseph Shadel || City Popular</title>
     <?php include 'header.php' ?>
  </head>
  <body>
    <div class="be-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
         
                        <?php include 'accountbar.php' ?>
            <div class="page-title"><span>Dashboard</span></div>
            <?php include 'notificationbar.php' ?>
          </div>
        </div>
      </nav>
       <?php include 'leftsidebar.php' ?>
      
      <div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">City</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="javascript:void(0);">Counties & City</a></li>
            <li> <a href="county.php">Counties</a></li>
                <li class="active"> <a href="javascript:void(0;">Popular City</a></li> 
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          
         <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Cities
                  <div class="tools"><a href="citylist.php?id=<?php echo base64_encode($countyid) ?> "><span class="icon mdi mdi-download"></span></a></div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>City</th>
                        <th>County</th>
                     
                         <th align="center">Featured Section 1</th>
                          <th align="center">Featured Section 2</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"select * from `city`  order by `name` ASC ");
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
                         <td class="center"><?php echo getcountynamebyid($conn,$fetch['cid'])?></td>
                        
                       <td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['sec1']  ?>" onClick="featurepropertysec1('<?php echo $fetch['id'];  ?>','city',6)" <?php if($fetch['sec1']==1){echo 'checked';} ?>>
       <label for="check<?php echo $fetch['id']  ?>" id="featuresec1<?php echo $fetch['id']  ?>"><?php echo getStatus($conn,$fetch['sec1']);  ?></label>
         <div id="status<?php echo $fetch['id']  ?>" ></div></div>
         </td>
                     <td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="checksec<?php echo $fetch['id']  ?>" value="<?php echo $fetch['sec2']  ?>" onClick="featurepropertysec2('<?php echo $fetch['id'];  ?>','city',7)" <?php if($fetch['sec2']==1){echo 'checked';} ?>>
       <label for="checksec<?php echo $fetch['id']  ?>" id="featuresec2<?php echo $fetch['id']  ?>"><?php echo getStatus($conn,$fetch['sec2']);  ?></label>
         <div id="status<?php echo $fetch['id']  ?>" ></div></div>
         </td>                       
                      </tr>
                      <?php }}else{?>
                      <tr class="even gradeC">
                        <td colspan="6">No records</td>
                         
                      </tr>
                      <?php }?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
     <?php include 'footer.php' ?>
  </body>


</html>