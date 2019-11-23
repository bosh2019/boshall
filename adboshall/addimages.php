<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");
checkIntrusion($conn,$uid);

$recordid=base64_decode($_GET['id']);
$alldetails=getpropertydetailsbyidassoc($conn,$recordid);
$ListId=$alldetails['ListingId'];

$productarr=getAllimageoflistId($conn,$ListId);
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Property image  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='Property image added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='Property image updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='Property image not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='Property image deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='Property image not deleted successfully !!!!';
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
$delQry=mysqli_query($conn,"delete from `pimages` where `id`='$did'");
	if($delQry){
		header("location:addimages.php?msg=dls&id=$countyid");
	}else{
		header("location:addimages.php?msg=dlf&id=$countyid");
	}
}


if(isset($_POST['submit'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$slug=strtolower(strreplace($conn,mysqli_real_escape_string($conn,$_POST['slug'])));
 $countyidnew=base64_decode($_GET['id']);

$countyid=$_GET['id'];

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
	
	
	
$sqlQry="INSERT INTO `pimages`(`name`,`imagepath`, `slug`, `status`,`cid`) VALUES ('$firstline','$imgName1','$slug','1','$countyidnew')";
$execQry=mysqli_query($conn,$sqlQry);
			

if($execQry){
	header("location:addimages.php?msg=ins&id=$countyid");
}else{
	header("location:addimages.php?msg=inf&id=$countyid");
}

}

if(isset($_POST['update'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$secondline=strtolower(strreplace($conn,mysqli_real_escape_string($conn,$_POST['slug'])));
$countyid=$_GET['id'];
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
		$resImgQry1=mysqli_fetch_row(mysqli_query($conn,"select `imagepath` from `pimages` where `id` = '$id'"));
	    $oldimg1=$resImgQry1[0];
	    $imgName1=$oldimg1;	
	}

$eiid=base64_encode($id);
$sqlQry="UPDATE `pimages` SET `name`='$firstline',`slug`='$secondline',`imagepath`='$imgName1' WHERE `id`='$id' ";
$execQry=mysqli_query($conn,$sqlQry);
	
if($execQry){
	header("location:addimages.php?msg=ups&id=$countyid");
}else{
	header("location:addimages.php?msg=upf&id=$countyid");
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
 
    <title><?php echo $pagename;?></title>
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
          <h2 class="page-head-title">Property Images</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="javascript:void(0)">Property</a></li>
           
                <li class="active"> <a href="javascript:void(0)">Images for Listing Id -'<?php echo $ListId;?>'</a></li> 
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          
         <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Property Images
                  
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Listing Id</th>
                        <th>Image</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
  $numrows=count($productarr);
	if($numrows>0){
	foreach($productarr as $imgurl)
	{
	$i++;
  ?> 
                      <tr class="<?= $class?> ">
                        <td class="center"><?= $i?></td>
                      
                        <td><?php echo $alldetails['ListingId']?></td>
                         <td class="center"><img src="<?= $imgurl?>" style="height:50px; width:78px;"></td>
                        
                      </tr>
                      <?php }}else{?>
                      <tr class="even gradeC">
                        <td colspan="3">No records</td>
                         
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