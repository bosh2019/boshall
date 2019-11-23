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
$delQry=mysqli_query($conn,"delete from `property` where `id`='$did'");
	if($delQry){
		header("location:addproperty.php?msg=dls");
	}else{
		header("location:addproperty.php?msg=dlf");
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
     <link rel="shortcut icon" href="assets/img/lttj.png">
    <title>Joseph Shadel || Property</title>
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
} </style>
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
          <h2 class="page-head-title">Property</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="allprpty.php">Property</a></li>
            
            <li class="active">Add Property</li>
          </ol>
        </div>
        <div class="main-content container-fluid">
          
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Add Property </div>
                <div class="panel-body">
                
                  <?php if($msg!=''){ ?>
                <div role="alert" class="<?php echo $class?>">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-<?php echo $iconmsg?>"></span><?php echo $msg?>
                  </div>
                  <?php }?>
                  <form  style="border-radius: 0px;" class="form-horizontal group-border-dashed" id="propertyformnewew" name="propertyformnewew" method="post" >
                    <?php 
					if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
                        $eid=base64_decode($_GET['eid']);
                        $execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `propertyfor` where `id`='$eid'"));
                       
						

                    ?>
                    <div class="form-group">
                      <label class="col-md-6"><strong style="font-size:  15px;">Property Details</strong></label>
                      
                    </div>
                          <div class="form-group">
                      <label class="col-md-6  ">Property Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="name" name="name">
                      </div>
                    </div>
                    
                   <div class="row">
                         <div class="col-md-3">
                              <div class="form-group">
                              <label class="col-md-12">Price</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="price" name="price">
                              </div>
                              </div>
                         </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                                      <label class="col-md-12">Price Desc</label>
                                                      <div class="col-md-12">
                                <input type="text" class="form-control" id="pdesc" name="pdesc">
                                                      </div>
                                                      </div>
                            </div>
                    </div>
                 
                  <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="col-md-12">Rooms</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="rooms" name="rooms">
                              </div>
                            </div>
                        </div>
                       <div class="col-md-3">
                           <div class="form-group">
                              <label class="col-md-12">Bedrooms</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="bedroom" name="bedroom">
                              </div>
                                            
                            </div>
                       </div>
                            <div class="col-md-3">
                                                    <div class="form-group">
                                                                    <label class="col-md-12">Bathrooms</label>
                                                                    <div class="col-md-12">
                                                                      <input type="text" class="form-control" id="bathrooms" name="bathrooms">
                                                                    </div>
                                            
                                                                  </div>
                                      </div>
                                   <div class="col-md-3">   <div class="form-group">
                                                                <label class="col-md-12">Lot area</label>
                                                                <div class="col-md-12">
                                                                  <input type="text" class="form-control" id="lotarea" name="lotarea">
                                                                </div>
                                                           
                                                              </div> </div>
                   </div>
                    
                  
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-md-12">Property For</label>
                              <div class="col-sm-12">
                              <?php 
                                 $sqlQry=mysqli_query($conn,"select * from `propertyfor` where `status`='1'  order by `id`  ");
                               $i=0;
                               $numrows=mysqli_num_rows($sqlQry);
                               if($numrows>0){
                               while($fetch=mysqli_fetch_array($sqlQry)){
                               $i++;
                               
                               
                           ?>
                               
                                <div class="be-radio be-radio-color inline">
                                  <input type="radio"   checked=""name="propertyfor" id="propertyfor<?php echo $fetch['id']?>" value="<?php echo $fetch['id']?>">
                                  <label for="propertyfor<?php echo $fetch['id']?>"><?php echo $fetch['name']?></label>
                                </div>
                               <?php }}?>
                              </div>
                            </div>
                       </div>
                       <div class="col-md-3"> 
                             <div class="form-group">
                              <label class="col-md-12">Property Type</label>
                              <div class="col-md-12">
                                <select class="form-control" name="propertytype" id="propertytype">
                                   <?php 
                                  $sqlQry=mysqli_query($conn,"select * from `propertytype` where `status`='1'  order by `id`  ");
                                $i=0;
                                $numrows=mysqli_num_rows($sqlQry);
                                if($numrows>0){
                                while($fetch=mysqli_fetch_array($sqlQry)){
                                $i++;
                                
                                
                            ?>
                                  <option value="<?php echo $fetch['id']?>"><?php echo $fetch['name']?></option>
                                 <?php }}?>
                                </select>
                              </div>
                            </div>
                        </div>
                   </div>
                    <div class="form-group">
                      <label class="col-md-6"><strong style=" font-size:  15px;">Address Map</strong></label>
                      
                    </div>
                    
                     <div class="row">
                         <div class="col-md-4">
                             <div class="form-group">
                              <label class="col-md-12">Street Number</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="streetno" name="streetno">
                              </div>
                              </div>
                         </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                                         <label class="col-md-12">Address</label>
                                                         <div class="col-md-12">
                                <input type="text" class="form-control" id="streetname" name="streetname">
                                                         </div>
                                                         </div>
                           </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <label class="col-md-12">Zipcode</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="zipcode" name="zipcode">
                              </div>
                              </div>
                          </div>
                     </div> 
                      <div class="row">
                             <div class="col-md-4">
                              <div class="form-group">
                              <label class="col-md-12">Latitude</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="lat" name="lat">
                              </div>
                              </div>
                          </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                                      <label class="col-md-12">Longitude</label>
                                                      <div class="col-md-12">
                                <input type="text" class="form-control" id="long" name="long">
                                                      </div>
                                                      </div>
                            </div>
                      </div>
                      
                     <div class="row">
                         <div class="col-md-4">
                               <div class="form-group">
                              <label class="col-md-12">County</label>
                              <div class="col-md-12">
                                <select class="form-control" name="county" id="county" onChange="getcitylistforptoperty(this.value)">
                                   <?php 
                                    $sqlQry=mysqli_query($conn,"select * from `county` where `status`='1'  order by `id`  ");
                                  $i=0;
                                  $numrows=mysqli_num_rows($sqlQry);
                                  if($numrows>0){
                                  while($fetch=mysqli_fetch_array($sqlQry)){
                                  $i++;
                                  
                                  
                              ?>
                                  <option value="<?php echo $fetch['id']?>"><?php echo $fetch['name']?></option>
                                 <?php }}?>
                                </select>
                              </div>
                                                  </div>
                          </div>
                                             <div class="col-md-4">
                            <div class="form-group">
                              <label class="col-md-12">City</label>
                              <div class="col-md-12" id="citydiv">
                                <select class="form-control" name="city" id="city">
                                  
                                  <option value="">Select City</option>
                              
                                </select>
                              </div>
                            </div>
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
                      <label class="col-md-6"><strong style="font-size:  15px;">Property Details</strong></label>
                      
                    </div> 
                     <div class="row">
                    <div class="col-md-6">
                          <div class="form-group">
                      <label class="col-md-6  ">Property Name</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control" id="name" name="name">
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group">
                      <label class="col-md-6  ">Property Slug</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control" id="slug" name="slug">
                      </div>
                    </div>
                    </div>
                    </div>
                  <div class="row">
                         <div class="col-md-3">
                              <div class="form-group">
                              <label class="col-md-12">Price</label>
                              <div class="col-md-12">
            <input type="text" class="form-control" id="price" name="price" onKeyPress="return isNumberKey(event)">
                              </div>
                              </div>
                         </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                                      <label class="col-md-12">Price Desc</label>
                                                      <div class="col-md-12">
                                <input type="text" class="form-control" id="pdesc" name="pdesc">
                                                      </div>
                                                      </div>
                            </div>
                    </div>
                 
                  <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="col-md-12">Rooms</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="rooms" name="rooms" onKeyPress="return isNumberKey(event)">
                              </div>
                            </div>
                        </div>
                       <div class="col-md-3">
                           <div class="form-group">
                              <label class="col-md-12">Bedrooms</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="bedroom" name="bedroom" onKeyPress="return isNumberKey(event)">
                              </div>
                                            
                            </div>
                       </div>
                            <div class="col-md-3">
                                                    <div class="form-group">
                                                                    <label class="col-md-12">Bathrooms</label>
                                                                    <div class="col-md-12">
                                                                      <input type="text" class="form-control" id="bathroom" name="bathroom" onKeyPress="return isNumberKey(event)">
                                                                    </div>
                                            
                                                                  </div>
                                      </div>
                                   <div class="col-md-3">   <div class="form-group">
                                                                <label class="col-md-12">Lot area</label>
                                                                <div class="col-md-12">
                                                                  <input type="text" class="form-control" id="lotarea" name="lotarea">
                                                                </div>
                                                           
                                                              </div> </div>
                   </div>
                    
                  
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-md-12">Property For</label>
                              <div class="col-sm-12">
                              <?php 
                                 $sqlQry=mysqli_query($conn,"select * from `propertyfor` where `status`='1'  order by `id`  ");
                               $i=0;
                               $numrows=mysqli_num_rows($sqlQry);
                               if($numrows>0){
                               while($fetch=mysqli_fetch_array($sqlQry)){
                               $i++;
                               
                               
                           ?>
                               
                                <div class="be-radio be-radio-color inline">
                                  <input type="radio"   checked=""name="propertyfor" id="propertyfor<?php echo $fetch['id']?>" value="<?php echo $fetch['id']?>">
                                  <label for="propertyfor<?php echo $fetch['id']?>"><?php echo $fetch['name']?></label>
                                </div>
                               <?php }}?>
                              </div>
                            </div>
                       </div>
                       <div class="col-md-6"> 
                             <div class="form-group">
                              <label class="col-md-12">Property Type</label>
                              <div class="col-md-12">
                                <select class="form-control" name="propertytype" id="propertytype">
                                   <?php 
                                  $sqlQry=mysqli_query($conn,"select * from `propertytype` where `status`='1'  order by `id`  ");
                                $i=0;
                                $numrows=mysqli_num_rows($sqlQry);
                                if($numrows>0){
                                while($fetch=mysqli_fetch_array($sqlQry)){
                                $i++;
                                
                                
                            ?>
                                  <option value="<?php echo $fetch['id']?>"><?php echo $fetch['name']?></option>
                                 <?php }}?>
                                </select>
                              </div>
                            </div>
                        </div>
                   </div>
                     <div class="form-group">
                      <label class="col-md-6">Property Description</label>
                      
                       <div class="col-md-12">
                                <textarea id="editor1" name="editor1" rows="8" cols="150"></textarea>
                              </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-6"><strong style=" font-size:  15px;">Address Map</strong></label>
                      
                    </div>
                    
                     <div class="row">
                         <div class="col-md-4">
                             <div class="form-group">
                              <label class="col-md-12">Street Number</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="streetno" name="streetno">
                              </div>
                              </div>
                         </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                                         <label class="col-md-12">Street Name</label>
                                                         <div class="col-md-12">
                                <input type="text" class="form-control" id="streetname" name="streetname">
                                                         </div>
                                                         </div>
                           </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <label class="col-md-12">Zipcode</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="zipcode" name="zipcode" onKeyPress="return isNumberKey(event)">
                              </div>
                              </div>
                          </div>
                     </div> 
                      <div class="row">
                             <div class="col-md-4">
                              <div class="form-group">
                              <label class="col-md-12">Latitude</label>
                              <div class="col-md-12">
                                <input type="text" class="form-control" id="lat" name="lat">
                              </div>
                              </div>
                          </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                                      <label class="col-md-12">Longitude</label>
                                                      <div class="col-md-12">
                                <input type="text" class="form-control" id="long" name="long">
                                                      </div>
                                                      </div>
                            </div>
                      </div>
                      
                     <div class="row">
                         <div class="col-md-4">
                               <div class="form-group">
                               <input type="hidden" name="cityhid" id="cityhid">
                              <label class="col-md-12">County</label>
                              <div class="col-md-12">
           <select class="form-control" name="county" id="county" onChange="getcitylistforptoperty(this.value)">
                                  <option value="">Select </option>
                                   <?php 
                                    $sqlQry=mysqli_query($conn,"select * from `county` where `status`='1'  order by `id`  ");
                                  $i=0;
                                  $numrows=mysqli_num_rows($sqlQry);
                                  if($numrows>0){
                                  while($fetch=mysqli_fetch_array($sqlQry)){
                                  $i++;
                                  
                                  
                              ?>
                                  <option value="<?php echo $fetch['id']?>"><?php echo $fetch['name']?></option>
                                 <?php }}?>
                                </select>
                              </div>
                                                  </div>
                          </div>
                                             <div class="col-md-4">
                            <div class="form-group">
                              <label class="col-md-12">City</label>
                              <div class="col-md-12" id="citydiv">
                                <select class="form-control" name="city" id="city">
                                         <option value="">Select City</option>
                               
                                </select>
                              </div>
                            </div>
                                             </div>
                     </div>
                    <div class="col-xs-6">
                        <p class="text-right">
                          <input type="submit" class="btn btn-space btn-primary btn-lg" name="submit" value="Submit">
                          <button class="btn btn-space btn-default btn-lg">Cancel</button>
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
                <div class="panel-heading">Property
              <!--    <div class="tools"><a href="propertyforlist.php"><span class="icon mdi mdi-download"></span></a></div>
          -->      </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Name</th>
                        <th align="center">Details</th>
                         <th align="center">Add Images</th>
                          <th>Add Amenities</th>
                        <th>Delete</th>
                       <!-- <th>Edit</th>-->
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
                         <td class="center"><a href="viewproperty.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-primary"><i class="icon icon-left mdi mdi-eye"> View</i></button> </a></td>
                          <td class="center"><a href="addimages.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-warning"><i class="icon icon-left mdi mdi-image"> Add</i></button> </a></td>
                             <td class="center"><a href="addamnenities.php?id=<?php echo base64_encode($fetch['id'])?>">  <button = class="btn btn-rounded btn-space btn-danger"><i class="icon icon-left mdi mdi-flower"> Add</i></button> </a></td>
                        
                        <td class="center" ><a href="addproperty.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><img src="<?php echo $baseurl;?>/images/trash.png" style="width:20px; height:20px"></a></td>
	<!--<td class="center" ><a href="addproperty.php?eid=<?php echo base64_encode($fetch['id']) ?>"><img src="<?php echo $baseurl;?>/images/pen.png" style="width:20px; height:20px">	</a></td>-->
		<td class="center" >
       <div class="be-checkbox be-checkbox-color inline"> <input class='uniform ap' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','property',14)" <?php if($fetch['status']==1){echo 'checked';} ?>>
       <label for="check<?php echo $fetch['id']  ?>" id="status<?php echo $fetch['id']  ?>"><?php echo getStatus($conn,$fetch['status']);  ?></label>
         <div id="status<?php echo $fetch['id']  ?>" ></div></div>
         </td>
                                            
                      </tr>
                      <?php }}else{?>
                      <tr class="even gradeC">
                        <td colspan="7">No records</td>
                         
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
     <script>
	
  </body>

</html>