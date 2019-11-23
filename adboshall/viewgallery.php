<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");
checkIntrusion($conn,$uid);

$countyid=base64_decode($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <link rel="shortcut icon" href="assets/img/lttj.png">
 
    <title>Joseph Shadel || Property Images</title>
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
            
            <li>Add Images</li>
             <li class="active">View Gallery '<?php echo getpropertynamefromid($conn,$countyid)?> '</li>
          </ol>
        </div>
       <div class="main-content container-fluid">
          <div class="gallery-container">
          

           <?php 
		  
  	$sqlQry=mysqli_query($conn,"select * from `pimages`  where `cid` ='$countyid'  and `status`='1' ");
	$i=0;
	$numrows=mysqli_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysqli_fetch_array($sqlQry)){
	$i++;
	 $imagetpat=$fetch['imagepath'];
	  ?> 
            <div class="item">
              <div class="photo">
                <div class="img"><img src="<?php echo $baseurl?>/photos/<?php echo $imagetpat?>" alt="Gallery Image">
                  <div class="over">
                    <div class="info-wrapper">
                      <div class="info">
                    <div class="description"><?php echo getpropertynamefromid($conn,$countyid)?></div>
                        <div class="func"><a href="<?php echo $baseurl?>/photos/<?php echo $imagetpat?>" class="image-zoom"><i class="icon mdi mdi-search"></i></a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
           <?php }}?>
            
            
            
          </div>
        </div>
        </div>
      </div>
      
    </div>
     <?php include 'footer.php' ?>
     <script>
	
  </body>

</html>