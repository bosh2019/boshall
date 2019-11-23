<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");
checkIntrusion($conn,$uid);

$countyid=base64_decode($_GET['id']);
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Budget  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='Budget not added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='Budget updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='Budget not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='Budget deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='Budget not deleted successfully !!!!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	if(isset($_GET['did'])&&$_GET['did']!=''){
$did=base64_decode($_GET['did']);
$countyid=$_GET['id'];
$delQry=mysqli_query($conn,"delete from `budget` where `id`='$did'");
	if($delQry){
		header("location:addbudget.php?msg=dls&id=$countyid");
	}else{
		header("location:addbudget.php?msg=dlf&id=$countyid");
	}
}


if(isset($_POST['submit'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$slug=strtolower(strreplace($conn,$firstline));
 $countyidnew=base64_decode($_GET['id']);

$countyid=$_GET['id'];

 
	
$sqlQry="INSERT INTO `budget`(`name`,`slug`, `status`,`cid`) VALUES ('$firstline','$slug','1','$countyidnew')";
$execQry=mysqli_query($conn,$sqlQry);
			

if($execQry){
	header("location:addbudget.php?msg=ins&id=$countyid");
}else{
	header("location:addbudget.php?msg=inf&id=$countyid");
}

}

if(isset($_POST['update'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$slug=strtolower(strreplace($conn,$firstline));
$countyid=$_GET['id'];
$id=$_POST['hidval'];

	
$eiid=base64_encode($id);

$

$eiid=base64_encode($id);
$sqlQry="UPDATE `budget` SET `name`='$firstline',`slug`='$slug' WHERE `id`='$id' ";
$execQry=mysqli_query($conn,$sqlQry);
	
if($execQry){
	header("location:addbudget.php?msg=ups&id=$countyid");
}else{
	header("location:addbudget.php?msg=upf&id=$countyid");
}

}	

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
     <link rel="shortcut icon" href="assets/img/lttj.png">
    <title>Joseph Shadel || Budget For <?php echo getpropertyforamebyid($conn,$countyid)?></title>
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
          <h2 class="page-head-title">Budget</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="javascript:void(0;">Masters</a></li>
            <li> <a href="addpropertyfor.php">Property For</a></li>
                <li class="active"> <a href="javascript:void(0;">Budget- For '<?php echo getpropertyforamebyid($conn,$countyid)?>'</a></li> 
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Add Budget </div>
                <div class="panel-body">
                
                  <?php if($msg!=''){ ?>
                <div role="alert" class="<?php echo $class?>">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-<?php echo $iconmsg?>"></span><?php echo $msg?>
                  </div>
                  <?php }?>
                  <form  style="border-radius: 0px;" class="form-horizontal group-border-dashed" id="budgetform" name="budgetform" method="post" enctype="multipart/form-data" >
                    <?php 
					if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
                        $eid=base64_decode($_GET['eid']);
                        $execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `budget` where `id`='$eid'"));
                       
						

                    ?>
                   <div class="form-group">
                      <label class="col-sm-3 control-label">Budget</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="firstline" name="firstline" value="<?php echo $execQry[2]?>">
                      </div>
                    </div>
                    <!--<div class="form-group">
                      <label class="col-sm-3 control-label">Slug</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $execQry[4]?>">
                      </div>
                    </div>-->
                  
                
              
              <input type="hidden" value="<?php echo $eid?>" name="hidval" id="hidval">
                    <input type="hidden" value="<?php echo base64_decode($_GET['id']);?>" name="countyidnew" id="countyidnew">
              
               
                   
                    
                   
                    
                    <div class="col-xs-6">
                        <p class="text-right">
                          <button type="submit" class="btn btn-space btn-primary" name="update">Update</button>
                          <button class="btn btn-space btn-default">Cancel</button>
                        </p>
                      </div>
                      
                      <?php } else{?>
                          <div class="form-group">
                      <label class="col-sm-3 control-label">Budget</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="firstline" name="firstline">
                      </div>
                    </div>
                   <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Slug</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="slug" name="slug">
                      </div>
                    </div>
                -->
                   
                    
                    <div class="col-xs-6">
                        <p class="text-right">
                          <input type="submit" class="btn btn-space btn-primary" name="submit" value="Submit">
                          <button class="btn btn-space btn-default">Cancel</button>
                        </p>
                      </div>
                      <?php }?>
                      
                      
                  </form>
                </div>
              </div>
            </div>
          </div>
         <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Budget
                  <div class="tools"><a href="budgetlist.php?id=<?php echo base64_encode($countyid) ?> "><span class="icon mdi mdi-download"></span></a></div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Budget</th>
                      
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"select * from `budget` where `cid`='$countyid'  order by `id` ASC ");
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
                        
                        
                        <td class="center" ><a href="addbudget.php?did=<?php echo base64_encode($fetch['id'])?>&id=<?php echo base64_encode($countyid)?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><img src="<?php echo $baseurl;?>/images/trash.png" style="width:20px; height:20px"></a></td>
	<td class="center" ><a href="addbudget.php?eid=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo base64_encode($countyid)?>"><img src="<?php echo $baseurl;?>/images/pen.png" style="width:20px; height:20px">	</a></td>
		<td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','budget',5)" <?php if($fetch['status']==1){echo 'checked';} ?>>
       <label for="check<?php echo $fetch['id']  ?>" id="status<?php echo $fetch['id']  ?>"><?php echo getStatus($conn,$fetch['status']);  ?></label>
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