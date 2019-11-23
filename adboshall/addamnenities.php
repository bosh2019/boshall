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
		$msg='Amenities  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='Amenities not added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='Amenities updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='Amenities not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='Amenities deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='Amenities not deleted successfully !!!!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}

if(isset($_POST['submit'])){
$id=$_POST['hidval'];
$newid=base64_encode($id);
$tags=$_POST['tags'];
$delSess=mysqli_query($conn,"delete from `prokeyword` where `p_id`='$id'");
if(count($tags)>0){
	foreach($tags as $sessid){
	$execqry=mysqli_query($conn,"INSERT INTO `prokeyword` (`p_id`,`k_id`,`status`) VALUES ('$id', '$sessid', '1')");    }}
	if($execqry)
	{       
				
	header("location:addamnenities.php?msg=ups&id=$newid");
}else{
	header("location:addamnenities.php?msg=upf&id=$newid");
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
 
    <title>Joseph Shadel || Property Amenities</title>
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
          <h2 class="page-head-title">Amentites</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="allprpty.php">Property</a></li>
          
                <li class="active"> <a href="javascript:void(0;">Add Amenities '<?php echo getpropertynamefromid($conn,$countyid)?>'</a></li> 
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Amenities </div>
                <div class="panel-body">
                
                  <?php if($msg!=''){ ?>
                <div role="alert" class="<?php echo $class?>">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-<?php echo $iconmsg?>"></span><?php echo $msg?>
                  </div>
                  <?php }?>
                  <form  style="border-radius: 0px;" class="form-horizontal group-border-dashed" id="addame" name="addame" method="post" enctype="multipart/form-data" >
                  
                  
					<?php 

					if(isset($_GET['id'])&&$_GET['id']!=''){ 

                        $eid=base64_decode($_GET['id']);

                       
                        $tags=getrproductkeyword($conn,$eid);
			

                    ?>

                 
                <div class="form-group">
                   
                       <div class="col-sm-12">
                        <?php 
  	$sqlQry=mysqli_query($conn,"select * from `amenties` where `status`='1' order by `id` ASC ");
	$i=0;
	$numrows=mysqli_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysqli_fetch_array($sqlQry)){
	$i++;
	?>
                    <div style="width:150px;margin:5px;padding:5px;border:dotted 1px #CCC;float:left;font-family:Calibri;font-size:12px;font-weight:bold;color:#930;">
                        <div class="be-checkbox be-checkbox-color inline">
                          <input id="<?php echo $fetch['id']?>" type="checkbox" name="tags[]"  <?php if(in_array($fetch['id'],$tags)) {?> checked <?php } ?> value="<?php echo $fetch['id']; ?>">
                          <label for="<?php echo $fetch['id']?>"><?php echo ucfirst($fetch['name'])?></label>
                          </div> 
                        </div>
                  
                        <?php }}?>
                         </div>
                    </div>
              <input type="hidden" value="<?php echo $eid?>" name="hidval" id="hidval">
                    <input type="hidden" value="<?php echo base64_decode($_GET['id']);?>" name="countyidnew" id="countyidnew">
              
               
                   
                    
                   
                    
                    <div class="col-xs-6">
                        <p class="text-right">
                          <button type="submit" class="btn btn-space btn-primary" name="submit">Update</button>
                          <button class="btn btn-space btn-default">Cancel</button>
                        </p>
                      </div>
                      
                     <?php }?>
                      
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