
<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");

$msg="Test msg";
$subject="Test mail";
$to="sakshi@dkd.co.in";
$fromname="Boshall";
$from="support@s1.dkddev.com";
$a=5;
$b=5.5;

  
abc($a,$b);
function abc(int $a,int $b)
{
		echo "here";

	return $a*$b;
	
	
	
}  die;
 echo 
 
 
 $to = "sakshi@dkd.co.in";
$subject = "My subject";
$txt = activationText($to,$id,$baseurl);
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers = "From: webmaster@example.com" . "\r\n" .

mail($to,$subject,$txt,$headers); 
 
 
  
//sendBasicMailSMTP($to,$from,$fromname,$subject,$msg); 

// Always set content-type when sending HTML email


// More headers
$headers .= 'From: <sakshi@dkd.co.in>' . "\r\n";

//mail($to,$subject,$msg,$headers);



?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>

$('#date').mask('00/00/0000');

</script>
<input type="text" name="field-name" id="date" />