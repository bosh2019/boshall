<?php
ob_start();
session_start();
$uid=$_SESSION['id'];
include("../configuration/connect.php");
include("../configuration/functions.php");
checkIntrusion($conn,$uid);

$pid=base64_decode($_GET['id']);
$productarr=getpropertydetailsbyidassoc($conn,$pid);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
 
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
.user-display-info {
    line-height: 20px;
    padding-left: 0px;
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
      
      <div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">Property</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="addproperty.php">Property</a></li>
            <li class="active">View Property- <?php echo $productarr[1]?></li>
            
          </ol>
        </div>
          
         
          
       <div class="main-content container-fluid">
          <div class="user-profile">
            <div class="row">
              <div class="col-md-12">
                <div class="user-display">
                  <div class="user-display-bg"><img src="<?php echo $baseurl?>/images/test.jpg" alt="Profile Background"></div>
                  <div class="user-display-bottom">
                
                    <div class="user-display-info">
                      <div class="name"><?php echo $productarr[1]?></div>
                      
                    </div>
                    <div class="row user-display-details">
                      <div class="col-xs-4">
                        <div class="title">Street Name</div>
                        <div class="counter"><?php echo $productarr['StreetName']?></div>
                      </div>
                      <div class="col-xs-4">
                        <div class="title">Street No</div>
                        <div class="counter"><?php echo $productarr['StreetNumber']?></div>
                      </div>
                         <div class="col-xs-4">
                        <div class="title">Zipcode</div>
                        <div class="counter"><?php echo $productarr['ZIP_CODE_4']?></div>
                      </div>
                      <div class="col-xs-4">
                        <div class="title">Latitude , Longitude</div>
                        <div class="counter"><?php echo $productarr['Latitude']?> ,<?php echo $productarr['Longitude']?></div>
                      </div>
                        <div class="col-xs-4">
                        <div class="title">County, City</div>
                        <div class="counter"><?php echo $productarr['CountyOrParish']?> , <?php echo $productarr['City']?></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="user-info-list panel panel-default">
                  <div class="panel-heading panel-heading-divider">Details</span></div>
                  <div class="panel-body">
                    <table class="no-border no-strip skills">
                      <tbody class="no-border-x no-border-y">
                        <tr>
                          <td class="icon"><span class="mdi mdi-checkbox-blank-circle"></span></td>
                          <td class="item">Price<span class="icon s7-portfolio"></span></td>
                          <td>$<?php echo $productarr['ListPrice']?></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-cash-multiple"></span></td>
                          <td class="item">Built Year<span class="icon s7-gift"></span></td>
                          <td><?php echo $productarr['YearBuilt']?></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-home-modern"></span></td>
                          <td class="item">Intrerior Features<span class="icon s7-phone"></span></td>
                          <td><?php echo $productarr['InteriorFeatures']?></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-home-modern"></span></td>
                          <td class="item">Exterior Features<span class="icon s7-map-marker"></span></td>
                          <td><?php echo $productarr['EXTERIOR']?></td>
                        </tr>
                         <tr>
                          <td class="icon"><span class="mdi mdi-home-modern"></span></td>
                          <td class="item">Bedrooms<span class="icon s7-global"></span></td>
                          <td><?php echo $productarr['BedroomsTotal']?></td>
                        </tr>
                        <tr>
                          <td class="icon"><span class="mdi mdi-home-modern"></span></td>
                          <td class="item">Bathrooms<span class="icon s7-global"></span></td>
                          <td><?php echo $productarr['BathroomsFull']?></td>
                        </tr>
                          <tr>
                          <td class="icon"><span class="mdi mdi-home-modern"></span></td>
                          <td class="item">Lot Size(Acres)<span class="icon s7-global"></span></td>
                          <td><?php echo $productarr['LotSizeAcres']?></td>
                        </tr>
                        <tr>
                           <td class="icon"><span class="mdi md"></span></td>
                          <td class="item">Property Type<span class="icon s7-global"></span></td>
                          <td><?php echo $productarr['PropertyType']?></td>
                        </tr>
                         
                         <tr>
                           <td class="icon"><span class="mdi mdi"></span></td>
                          <td class="item">Property Description<span class="icon s7-global"></span></td>
                          <td><?php echo $productarr['PublicRemarks']?></td>
                        </tr>
                     
                      </tbody>
                    </table>
                <table> <tr> <td> <a href="view_property.php"> <input type="button" class="btn btn-space btn-primary btn-lg"  value="Back"></a></td></tr></table>
                  </div>
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