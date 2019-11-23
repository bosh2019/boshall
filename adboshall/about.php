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
		$msg='Content  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='Content not added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='Content updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='Content not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='Content deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='Content not deleted successfully !!!!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	if(isset($_POST['update'])){
	
$sname=mysqli_real_escape_string($conn,$_POST['editor1']);

$sqlQry="UPDATE `aboutus` SET `content`='$sname' WHERE `id`='1' ";
$execQry=mysqli_query($conn,$sqlQry);
	
if($execQry){
	header("location:about.php?msg=ups");
}else{
	header("location:about.php?msg=upf");
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
    <title>Joseph Shadel || About Us</title>
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
          <h2 class="page-head-title">About Us</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
         
            <li class="active">About Us</li>
          </ol>
        </div>
        <div class="main-content container-fluid">
          <!--Summernote-->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">About Us Content</div>
               <div class="panel-body">
                   <?php if($msg!=''){ ?>
                <div role="alert" class="<?php echo $class?>">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-<?php echo $iconmsg?>"></span><?php echo $msg?>
                  </div>
                    <?php }?>
               <form name="aboutform" id="aboutform" method="post">
                <?php 
			 $execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `aboutus` where `id`='1'"));
                        $name=htmlentities(stripslashes($execQry[2]));

                    ?>
                <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $name?></textarea>
                 <div class="col-xs-6">
                        <p class="text-right">
                          <input type="submit" class="btn btn-space btn-primary" name="update" value="Update">
                          <button class="btn btn-space btn-default">Cancel</button>
                        </p>
                      </div>
                      </form>
                </div>
              </div>
            </div>
          </div>
          <!--Bootstrap Markdown-->
          
        </div>
      </div>
    
    </div>
         <?php include 'footer.php' ?>

  </body>

</html>