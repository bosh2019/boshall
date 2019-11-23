<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
//$actual_url=$_SERVER['REQUEST_URI'];
unset($_SESSION['id']);  

header("location:$baseurl");
?>