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
		$msg='Contact Details  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='Contact Details not added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='Contact Details updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='Contact Details not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='Contact Details deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='Contact Details not deleted successfully !!!!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}


if(isset($_POST['update'])){
	
$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$skype=mysqli_real_escape_string($conn,$_POST['skype']);

$office=mysqli_real_escape_string($conn,$_POST['office']);

$address=mysqli_real_escape_string($conn,$_POST['address']);

$sqlQry="UPDATE `contact` SET `name`='$name',`email`='$email',`mobile`='$mobile',`skype`='$skype',`office`='$office',`address`='$address' WHERE `id`='1' ";
$execQry=mysqli_query($conn,$sqlQry);
	
if($execQry){
	header("location:contact.php?msg=ups");
}else{
	header("location:contact.php?msg=upf");
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
          <h2 class="page-head-title">Contact Details</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li class="active">Contact Details</li>
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Add Contact Details </div>
                <div class="panel-body">
                
                  <?php if($msg!=''){ ?>
                <div role="alert" class="<?php echo $class?>">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-<?php echo $iconmsg?>"></span><?php echo $msg?>
                  </div>
                  <?php }?>
                  <form  style="border-radius: 0px;" class="form-horizontal group-border-dashed" id="contactform" name="contactform" method="post" >
                    <?php 
					
                        $execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `contact` where `id`='1'"));
                       
						

                    ?>
                      <div class="form-group">
                      <label class="col-sm-3 control-label">Contact Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo  $execQry[1]?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo  $execQry[2]?>">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">Office</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="office" name="office" value="<?php echo  $execQry[6]?>">
                      </div>
                      </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">Mobile</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo  $execQry[3]?>">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">Skype</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="skype" name="skype" value="<?php echo  $execQry[4]?>">
                      </div>
                    </div>
               <div class="form-group">
                      <label class="col-sm-3 control-label">Address</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo  $execQry[7]?>">
                      </div>
                    </div>
                   
                    
                    <div class="col-xs-6">
                        <p class="text-right">
                          <button type="submit" class="btn btn-space btn-primary" name="update">Update</button>
                          <button class="btn btn-space btn-default">Cancel</button>
                        </p>
                      </div>
                      
                   
                      
                      
                  </form>
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