<?php
include_once('global.php');

date_default_timezone_set('Asia/Calcutta'); 
//$baseurl="http://www.ani.acresninches.com";
         $dbhost = $Global['host'];
         $dbuser = $Global['username'];
         $dbpass = $Global['password'];
         $dbname = $Global['database'];
          global $conn;
	      $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
       // 
         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }
		 

?>
