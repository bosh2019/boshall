<?php 
ob_start();		
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$userid=$_SESSION['id'];

$pdate=date("Y-m-d");
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];
 $phone=$_POST['phone'];
 $email=$_POST['email'];
 $usernotes=$_POST['usernotes'];
 $realstate=$_POST['realstate'];
$propertyid=$_POST['listid'];
$bookdate=$_POST['hiddendate'];
	
$sel=mysqli_query($conn,"INSERT INTO `bookings`( `fname`, `lname`, `email`, `phone`, `realstate`, `pdate`, `bookdate`, `booktime`, `propertyid`,`notes`) VALUES ('$fname','$lname','$email','$phone','$realstate','$pdate','$bookdate','$booktime','$propertyid','$usernotes')");

if($sel)
{
	
	$booking_date=changeDateFormat($conn,$bookdate);
	$notice_msg="New inquiry for Listing Id ".$propertyid." is received by  ".$fname;
	$notice_query=mysqli_query($conn,"INSERT INTO `notices`(`notice`, `pdate`, `visible`) VALUES ('$notice_msg','$pdate','0')");
	if($notice_query)
	{
		if($usernotes=="")
		{
			
		$usernotes="N/A";	
		}
		
$message = '<html><head></head>
<body>
<p>Property Booking Enquiry</p>
<table border="1" style="border-collapse:collapse;">
<tr style="background:#fff"><th style="text-align:left; width:100px; height:30px; padding:0 5px">Name</th><td style="text-align:left; width:100px;padding:0 5px">'.$fname." ".$lname.'</td></tr> 
<tr style="background:#f5f5f5"><th style="text-align:left; width:100px; height:30px; padding:0 5px">Mobile no.</th><td style="text-align:left; width:100px;padding:0 5px">'.$phone.'</td></tr>
<tr style="background:#fff"><th style="text-align:left; width:100px; height:30px; padding:0 5px">Message</th><td style="text-align:left; width:100px;padding:0 5px">'.$usernotes.'</td></tr>
<tr style="background:#fff"><th style="text-align:left; width:100px; height:30px; padding:0 5px">Email id</th><td style="text-align:left; width:100px;padding:0 5px">'.$email.'</td></tr>
<tr style="background:#fff"><th style="text-align:left; width:100px; height:30px; padding:0 5px">Booking Date</th><td style="text-align:left; width:100px;padding:0 5px">'.$booking_date.'</td></tr>
<tr style="background:#fff"><th style="text-align:left; width:100px; height:30px; padding:0 5px">Listing Id</th><td style="text-align:left; width:100px;padding:0 5px">'.$propertyid.'</td></tr>
</table>
</body>
</html>
';
/*$headers.= "MIME-Version: 1.0" . "\r\n";   
$headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers.= "From: sakshi@dkd.co.in" . "\r\n" .*/

$email_from='New Enquiry ';
$to="jwangyz@gmail.com ";
//$to="sakshi@dkd.co.in";

$subject="New Enquiry";
$from="";
$fromname="";
sendBasicMail($to,$from,$fromname,$subject,$message);
//addpasswordnotice($msg,$to);
 // mail($to,$subject,$message,$headers);
			//mail($to,$subject,$message,$headers);
		
		
$arr=array("status"=>1);	
	}
	
	else
	{
	$arr=array("status"=>0);	
	
		
	}
}


else
{
$arr=array("status"=>0);	
	
	
	
	
}
  
  header('Content-type: application/json');

		echo json_encode($arr); 

?>