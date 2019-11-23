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
    <title><?php echo $pagename;?></title>
     <?php include 'header.php' ?>
 <style>
	 .widget.widget-tile .data-info .desc {
        font-size: 22px;
    line-height: 24px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #566367;
    letter-spacing: 1px;
    padding-top: 10px;
}

.widget {
    border-radius: 8px;
}

.widget.widget-tile {
    margin-bottom: 25px;
    display: table;
    text-align: center;
    width: 100%;
    background-color: white;
    box-shadow: 0 0 12px #f1f1f1;
}
.widget.widget-tile .data-info {
    /* display: table-cell; */
    /* text-align: right; */
}

	 </style>
  </head>
  <body>
    <div class="be-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
         
                        <?php include 'accountbar.php' ?>
            <div class="page-title"><span>Settings</span></div>
            <?php include 'notificationbar.php' ?>
            
          </div>
        </div>
      </nav>
       <?php include 'leftsidebar.php' ?>
      <div class="be-content">
      
        <div class="main-content container-fluid">
          <div class="row">
          
           <a href="contact.php">    <div class="col-xs-12 col-md-6 col-lg-4">
                        <div class="widget widget-tile">
                          <div  ><img src="<?php echo $baseurl?>/images/download.png" style="width:55px; height:55px"></div>
                          <div class="data-info">
                            <div class="desc">Contact Details</div>
                            
                          </div>
                        </div>
            </div></a>
             <a href="sociallinks.php"><div class="col-xs-12 col-md-6 col-lg-4">
                        <div class="widget widget-tile">
                         <div  ><img src="<?php echo $baseurl?>/images/oop.png" style="width:73px; height:55px"></div>
                          <div class="data-info">
                            <div class="desc">Social Links</div>
                            
                          </div>
                        </div>
            </div></a>
         <a href="changepss.php">     <div class="col-xs-12 col-md-6 col-lg-4">
                        <div class="widget widget-tile">
                         <div  ><img src="<?php echo $baseurl?>/images/chn.png" style="width:55px; height:55px"></div>
                          <div class="data-info">
                            <div class="desc">Password</div>
                            
                          </div>
                        </div>
            </div></a>
          </div>
          
          
          
          
        </div>
      </div>
    
    </div>
         <?php include 'footer.php' ?>

  </body>

</html>