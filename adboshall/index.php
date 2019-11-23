<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

 
$page_details=getpagetitle($conn);
$pagename=$page_details['name'];

//echo $baseurl;?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/lttj.png">
    <title><?php echo $pagename;?></title> 
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
   
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><img src="../images/adminlogo.png"><span class="splash-description">Please enter your user information.</span></div>
              <div class="panel-body">
                <form method="post" id="adminlogin" name="adminlogin">
                  <div class="form-group">
                    <input id="username" name="username" type="text" placeholder="Email" autocomplete="off" class="form-control">
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" name="password" placeholder="Password" class="form-control">
                  </div>
                  <div class="form-group row login-tools">
                   <!--<a href="#">Forgot Password?</a></div>
                -->
                  <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
     <script src="assets/lib/jquery/jquery.validate.js" type="text/javascript"></script>
    
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo $baseurl;?>/javascript/scripts.js" type="text/javascript"></script> 
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
      
    </script>
  </body>


</html>