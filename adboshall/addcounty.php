<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");
checkIntrusion($conn,$uid);

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='County  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='County not added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='County updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='County not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='County deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='County not deleted successfully !!!!';
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
$delQry=mysqli_query($conn,"delete from `county` where `id`='$did'");
	if($delQry){
		header("location:addcounty.php?msg=dls");
	}else{
		header("location:addcounty.php?msg=dlf");
	}
}


if(isset($_POST['submit'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$slug=strtolower(strreplace($conn,mysqli_real_escape_string($conn,$_POST['slug'])));


 $medicalin=$_FILES['image']['name'];
	
	if(!$medicalin==''){
		$newsimagename1=basename($_FILES['image']['name']);
		$newsimagenamesrc1=$_FILES['image']['tmp_name'];
		$postednewsdate1=base64_encode(date('Y-m-d h:i:s'));
		$imgName1=$postednewsdate1."_".$newsimagename1;
		$moveimg1=move_uploaded_file($newsimagenamesrc1,'../photos/'.$imgName1);
		if(!$moveimg1){
			$successflag1=0;	
		}
	
	}else{
	  $imgName1="";	
	}
	
	
	
$sqlQry="INSERT INTO `county`(`name`,`imagepath`, `slug`, `status`) VALUES ('$firstline','$imgName1','$slug','1')";
$execQry=mysqli_query($conn,$sqlQry);
			

if($execQry){
	header("location:addcounty.php?msg=ins");
}else{
	header("location:addcounty.php?msg=inf");
}

}

if(isset($_POST['update'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$secondline=strtolower(strreplace($conn,mysqli_real_escape_string($conn,$_POST['slug'])));

$id=$_POST['hidval'];

	
$eiid=base64_encode($id);

$nwsimg1=$_FILES['image1']['name'];
	
	if(!$nwsimg1==''){
		$newsimagename1=basename($_FILES['image1']['name']);
		$newsimagenamesrc1=$_FILES['image1']['tmp_name'];
		$postednewsdate1=base64_encode(date('Y-m-d h:i:s'));
		$imgName1=$postednewsdate1."_".$newsimagename1;
		$moveimg1=move_uploaded_file($newsimagenamesrc1,'../photos/'.$imgName1);
		if(!$moveimg1){
			$successflag1=0;	
		}
	
	}else{
		$resImgQry1=mysqli_fetch_row(mysqli_query($conn,"select `imagepath` from `county` where `id` = '$id'"));
	    $oldimg1=$resImgQry1[0];
	    $imgName1=$oldimg1;	
	}

$eiid=base64_encode($id);
$sqlQry="UPDATE `county` SET `name`='$firstline',`slug`='$secondline',`imagepath`='$imgName1' WHERE `id`='$id' ";
$execQry=mysqli_query($conn,$sqlQry);
	
if($execQry){
	header("location:addcounty.php?msg=ups");
}else{
	header("location:addcounty.php?msg=upf");
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
    <title>Joseph Shadel || County & City</title>
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
          <h2 class="page-head-title">County</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="javascript:void(0);">Counties & City</a></li>
            <li class="active">Counties</li>
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Add Counties </div>
                <div class="panel-body">
                
                  <?php if($msg!=''){ ?>
                <div role="alert" class="<?php echo $class?>">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-<?php echo $iconmsg?>"></span><?php echo $msg?>
                  </div>
                  <?php }?>
                  <form  style="border-radius: 0px;" class="form-horizontal group-border-dashed" id="countyform" name="countyform" method="post" enctype="multipart/form-data" >
                    <?php 
					if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
                        $eid=base64_decode($_GET['eid']);
                        $execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `county` where `id`='$eid'"));
                       
						

                    ?>
                   <div class="form-group">
                      <label class="col-sm-3 control-label">County</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="firstline" name="firstline" value="<?php echo $execQry[1]?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Slug</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $execQry[3]?>">
                      </div>
                    </div>
                   <div class="form-group">
                      <label class="col-sm-3 control-label">Image</label>
                      <div class="col-sm-3">
                        <input type="file"  class="form-control" name="image1" id="image1">
                        </div>
                 <div class="col-sm-3">
                       
                   <img src="<?php echo $baseurl?>/photos/<?php echo $execQry[2]?>" style="width:86px;  height:70px"/>
                       </div> 
                    </div>
              
              <input type="hidden" value="<?php echo $eid?>" name="hidval" id="hidval">
               
                   
                    
                   
                    
                    <div class="col-xs-6">
                        <p class="text-right">
                          <button type="submit" class="btn btn-space btn-primary" name="update">Update</button>
                          <button class="btn btn-space btn-default">Cancel</button>
                        </p>
                      </div>
                      
                      <?php } else{?>
                          <div class="form-group">
                      <label class="col-sm-3 control-label">County</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="firstline" name="firstline">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Slug</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="slug" name="slug">
                      </div>
                    </div>
                   <div class="form-group">
                      <label class="col-sm-3 control-label">Image</label>
                      <div class="col-sm-6">
                        <input type="file"  class="form-control" name="image" id="image">
                      </div>
                    </div>
                   
                   
                    
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
                <div class="panel-heading">Counties
                  <div class="tools"><a href="countylist.php"><span class="icon mdi mdi-download"></span></a></div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>County</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  	$sqlQry=mysqli_query($conn,"select * from `county`  order by `id` ASC ");
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
                         <td class="center"><img src="<?= $baseurl?>/photos/<?php echo $fetch['imagepath']?>" style="height:50px; width:78px;"></td>
                        
                        <td class="center" ><a href="addcounty.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><img src="<?php echo $baseurl;?>/images/trash.png" style="width:20px; height:20px"></a></td>
	<td class="center" ><a href="addcounty.php?eid=<?php echo base64_encode($fetch['id']) ?>"><img src="<?php echo $baseurl;?>/images/pen.png" style="width:20px; height:20px">	</a></td>
		<td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','county',3)" <?php if($fetch['status']==1){echo 'checked';} ?>>
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