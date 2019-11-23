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
		$msg='Property  added Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'inf':
		$msg='Property not added Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'ups':
		$msg='Property updated Successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'upf':
		$msg='Property not updated Successfully !!';
		$class='alert alert-danger alert-dismissible';
		$iconmsg='close-circle-o';
	break;
	case 'dls':
		$msg='Property deleted successfully !!';
		$class='alert alert-success alert-dismissible';
		$iconmsg='check';
	break;
	
	case 'dlf':
		$msg='Property not deleted successfully !!!!';
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
$delQry=mysqli_query($conn,"update `mlspindata_master` set `view`='0' where `id`='$did'");
	if($delQry){
		header("location:view_property.php?msg=dls");
	}else{
		header("location:view_property.php?msg=dlf");
	}
}


if(isset($_POST['submit'])){
	
$name=mysqli_real_escape_string($conn,$_POST['name']);
$price=mysqli_real_escape_string($conn,$_POST['price']);
$pdesc=mysqli_real_escape_string($conn,$_POST['pdesc']);
$rooms=mysqli_real_escape_string($conn,$_POST['rooms']);
$bedroom=mysqli_real_escape_string($conn,$_POST['bedroom']);
$bathroom=mysqli_real_escape_string($conn,$_POST['bathroom']);
$lotarea=mysqli_real_escape_string($conn,$_POST['lotarea']);
$streetno=mysqli_real_escape_string($conn,$_POST['streetno']);
$streetname=mysqli_real_escape_string($conn,$_POST['streetname']);
$zipcode=mysqli_real_escape_string($conn,$_POST['zipcode']);
$lat=mysqli_real_escape_string($conn,$_POST['lat']);
$long=mysqli_real_escape_string($conn,$_POST['long']);
 $pdate=date("Y-m-d");
 $propertyfor=$_POST['propertyfor'];
 $propertytype=$_POST['propertytype'];
 $county=$_POST['county'];
 $city=$_POST['cityhid'];
  $slugnew=mysqli_real_escape_string($conn,$_POST['slug']);
$editor1=mysqli_real_escape_string($conn,$_POST['editor1']);

 
  $slug=strtolower(strreplace($conn,$slugnew));

	
	
$sqlQry="INSERT INTO `property`( `name`, `price`, `pdesc`, `rooms`, `bedroom`, `bathroom`, `lotarea`, `streetno`, `streetname`, `zipcode`, `lat`, `long`, `pdate`, `status`,`propertyfor`, `ptype`, `conty`, `union`, `desc`,`slug`) VALUES ('$name','$price','$pdesc','$rooms','$bedroom','$bathroom','$lotarea','$streetno','$streetname','$zipcode','$lat','$long
','$pdate','1','$propertyfor','$propertytype','$county','$city','$editor1','$slug')";
$execQry=mysqli_query($conn,$sqlQry);
			

if($execQry){
	header("location:addproperty.php?msg=ins");
}else{
	header("location:addproperty.php?msg=inf");
}

}

if(isset($_POST['update'])){
	
$firstline=mysqli_real_escape_string($conn,$_POST['firstline']);
$slug=strtolower(str_replace($conn,$firstline));

$id=$_POST['hidval'];

	
$eiid=base64_encode($id);
$sqlQry="UPDATE `propertyfor` SET `name`='$firstline',`slug`='$slug' WHERE `id`='$id' ";
$execQry=mysqli_query($conn,$sqlQry);

	
if($execQry){
	header("location:addproperty.php?msg=ups");
}else{
	header("location:addproperty.php?msg=upf");
}

}	

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
     <link rel="shortcut icon" href="assets/img/lttj.png">
    <title><?php echo $pagename;?></title>
     <?php include 'header.php' ?>
     <style>
/*
	.col-md-4 {
    width: 15.333333%;
}
*/  
	.form-control {
    width: 100%;
    height: 44px;
    background-color: #fff;
    background-image: none;
    border: 1px solid #d5d8de;
    border-radius: 2px;
}

div.container {
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 100px auto;
			    line-height:30px;
			    max-width:760px;
			}
			body {
			    background: #f7f7f7;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}


 </style>
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
	<head>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() { 
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"employee-grid-data-buy.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
         <div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">Property</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="javascript:void(0)">Property</a></li>   
            
            <li class="active">View Property</li>
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          
         <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Property
              <!--    <div class="tools"><a href="propertyforlist.php"><span class="icon mdi mdi-download"></span></a></div>
          -->      </div>
                <div class="panel-body">
                  <table id="employee-grid"  class="table table-striped table-hover table-fw-widget">
					<thead>
						<tr>
							<th>Type</th>
							<th>Listing Id</th>
							<th>County Or Parish</th>
                            <th>Details</th>
                            <th>Images</th>


						</tr>
					</thead>
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
