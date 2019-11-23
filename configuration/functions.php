<?php
include_once("global.php");
  $baseurl=$Global['baseurl'];
include_once('class.phpmailer.php');

 include_once('class.smtp.php');
$page_details=getpagetitle($conn);
$pagename=$page_details['name'];

function GetupenhouseDetails($conn,$id)
{
	
	$query = mysqli_query($conn,"select * from `mlspin_openhouse` where `ListingId`='$id'");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     
	
	
	
	
}


function getpagetitle($conn)
{
	
	$query = mysqli_query($conn,"select * from `pagetitle` where `view`='1' and `status`='1' order by `id` desc limit 0,1");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     
	
}





function GetRegisterationDetails($conn,$id)
{
	
	$query = mysqli_query($conn,"select * from `register` where `id`='$id'");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     
	
	
	
	
}

function getpropertDetailsFromListId($conn,$id)
{
	
	$query = mysqli_query($conn,"select * from `mlspindata_master` where `ListingId`='$id' and `view`='1'");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     
	
	
	
	
}

function getpropertDetailsFromListId2($conn,$id)
{
	
	$query = mysqli_query($conn,"SELECT * FROM `mlspindata_master` WHERE `ListingId`='$id' AND `view`='1'");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     	
}


function getPropertybycity($conn,$id)
{
	
	$query = mysqli_query($conn,"select * from `mlspindata_master` where `city`='$id' and `view`='1' order by rand() limit 0,1");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     
	
	
	
	
}
function getPropertybycity2($conn,$id)
{
	
	$query = mysqli_query($conn,"select * from `mlspindata_master` where `city`='$id' and `view`='1' and `list_date`=CURRENT_DATE() order by rand() limit 0,1");
    $result = mysqli_fetch_assoc($query); 
    return $result;	     
	
	
	
	
}

function gethomebannerSingleImage($conn)
{
	$execQry=mysqli_query($conn,"select `imagepath` from `homebanner` where `status`='1' order by `id` desc limit 0,1");
 $result = mysqli_fetch_row($execQry); 
    return $result[0];	     
	
	
	
	
	
}
function countqenquiry($conn,$pid){
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"SELECT count(`id`) from proenq where `propid` ='$pid' "));
	return $fetchRes[0];
}

//function for count number of homes by city name

function homecountfromcityname($conn,$cityname){
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"SELECT count(`id`) from `mlspindata_master` WHERE `City` LIKE '%$cityname%' AND `PropertyType`!='Rental'"));
	return $fetchRes[0];
}


//function for get minimum cost and max cost by city name


function getminhomepricebycity($conn,$cityname){

//echo "select min(`eprice`) from `products` where `cid` ='$id' and `status`='1' ";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select min(`ListPrice`) from `mlspindata_master` where `City` like '%$cityname%' "));



	$id= $fetchRes[0];



	return $id;


}

function getminhomepricebycityWithType($conn,$cityname,$type){

//echo "select min(`eprice`) from `products` where `cid` ='$id' and `status`='1' ";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"SELECT min(`ListPrice`+ 0) FROM `mlspindata_master` WHERE `City` LIKE '%$cityname%' AND `PropertyType` NOT LIKE '%$type'"));



	$id= $fetchRes[0];



	return $id;


}
function getmaxhomepricebycity($conn,$cityname){

//echo "select max(`eprice`) from `products` where `cid` ='$id' and `status`='1' ";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select max(`ListPrice`) from `mlspindata_master` where `City` like '%$cityname%' "));



	$id= $fetchRes[0];



	return $id;


}


function getmaxhomepricebycityWithType($conn,$cityname,$type){

//echo "select max(`eprice`) from `products` where `cid` ='$id' and `status`='1' ";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"SELECT max(`ListPrice` + 0) FROM `mlspindata_master` WHERE `City` LIKE '%$cityname%' AND `PropertyType` NOT LIKE '%$type'"));




	$id= $fetchRes[0];



	return $id;


}
function getpropertycountbycity($conn,$id)
{
$execQry=mysqli_query($conn,"select * from `property`  where `status`='1' and `union`='$id'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$quesids[]=$fetch['id'];
			
		}}


	$mincost=count($quesids);

return $mincost;
}


function createThumbNailnewww($oldname,$width,$height,$baseurl,$listid){


 
if($oldname==''){



 $oldname='property.png';	



}


//$oldname="test";
	 $imgName=$width."_".$height."_".$listid.".jpeg";
$newname = $baseurl."/thumb/". $imgName;

	

	

	   if(!file_exists($newname)){

	

	$thumbw = $width;



	$thumbh = $height;



	$nh = $thumbh;



	$nw = $thumbw;



	 $size = getImageSize($oldname);

//print_r($size);

	$w = $size[0];



	$h = $size[1];



	$img_type=$size[2];



	$ratio = $h / $w;



	$nratio = $nh / $nw; 







  if($ratio > $nratio)



  {



    $x = intval($w * $nh / $h);



    if ($x < $nw)



    {



      $nh = intval($h * $nw / $w);



    } 



    else



    {



      $nw = $x;



    }



  }



  else



  {



    $x = intval($h * $nw / $w);



    if ($x < $nh)



    {



      $nw = intval($w * $nh / $h);



    } 



    else



    {



      $nh = $x;



    }



  }  

	switch($img_type) {



          case '1':



          $resimage = imagecreatefromgif($oldname);



          break;



          case '2':



          $resimage = imagecreatefromjpeg($oldname);



          break;



          case '3':



          $resimage = imagecreatefrompng($oldname);



          break;



      }







  //$resimage = imagecreatefromjpeg($oldname); 



  $newimage = imagecreatetruecolor($nw, $nh);  



  // use alternate function if not installed



  imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);



  



  // Making the final cropped thumbnail



  



  $viewimage = imagecreatetruecolor($thumbw, $thumbh);



  imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);



  



  // saving



  imagejpeg($viewimage, $newname, 85);







	return $imgName;

	   }else{

	return $imgName;   

	}

}



function thumbNail($oldname,$width,$height){

	 $imgName=$width."_".$height."_".$oldname;

	 $newname = "thumb/". $imgName;  

 if(!file_exists($newname)){

		$imgpath=$width."_".$height."_".$oldname;

	

		$size = getImageSize("photos/".$oldname);

		$w = $size[0];

		$h = $size[1];

		$img_type=$size[2];

		//die($img_type);

	switch($img_type) {

          case '1':

          $resimage = imagecreatefromgif("photos/".$oldname);

          break;

          case '2':

          $resimage = imagecreatefromjpeg("photos/".$oldname);

          break;

          case '3':

          $resimage = imagecreatefrompng("photos/".$oldname);

          break;

      }

	 $thumb = thumbnail_boxs($resimage, $width, $height);

	 imagedestroy($resimage);

	if(is_null($thumb)) {

		/* image creation or copying failed */

		header('HTTP/1.1 500 Internal Server Error');

		exit();

	}

	 imagejpeg($thumb,$newname);

	 	return  $imgName;	  



	}else{

		return  $imgName;	  



	}

}


function thumbnail_boxs($img, $box_w, $box_h) {

    //create the image, of the required size

	//$img="photos/".$img;

    $new = imagecreatetruecolor($box_w, $box_h);

    if($new === false) {

        return null;

    }





 

    $fill = imagecolorallocate($new, 255, 255, 255);

    imagefill($new, 0, 0, $fill);



   

    $hratio = $box_h / imagesy($img);

    $wratio = $box_w / imagesx($img);

    $ratio = min($hratio, $wratio);



    //if the source is smaller than the thumbnail size, 

    //don't resize -- add a margin instead

    //(that is, dont magnify images)

    if($ratio > 1.0)

        $ratio = 1.0;



    //compute sizes

    $sy = floor(imagesy($img) * $ratio);

    $sx = floor(imagesx($img) * $ratio);



    //compute margins

    //Using these margins centers the image in the thumbnail.

    //If you always want the image to the top left, 

    //set both of these to 0

    $m_y = floor(($box_h - $sy) / 2);

    $m_x = floor(($box_w - $sx) / 2);



    //Copy the image data, and resample

    //

    //If you want a fast and ugly thumbnail,

    //replace imagecopyresampled with imagecopyresized

    if(!imagecopyresampled($new, $img,

        $m_x, $m_y, //dest x, y (margins)

        0, 0, //src x, y (0,0 means top left)

        $sx, $sy,//dest w, h (resample to this size (computed above)

        imagesx($img), imagesy($img)) //src w, h (the full size of the original)

    ) {

        //copy failed

        imagedestroy($new);

        return null;

    }

    return $new;

}



function thumbnail_boxs_color($img, $box_w, $box_h,$red,$green,$blue) {

    //create the image, of the required size

	//$img="photos/".$img;

    $new = imagecreatetruecolor($box_w, $box_h);

    if($new === false) {

        return null;

    }





 

    $fill = imagecolorallocate($new, $red, $green, $blue);

    imagefill($new, 0, 0, $fill);



   

    $hratio = $box_h / imagesy($img);

    $wratio = $box_w / imagesx($img);

    $ratio = min($hratio, $wratio);



    //if the source is smaller than the thumbnail size, 

    //don't resize -- add a margin instead

    //(that is, dont magnify images)

    if($ratio > 1.0)

        $ratio = 1.0;



    //compute sizes

    $sy = floor(imagesy($img) * $ratio);

    $sx = floor(imagesx($img) * $ratio);



    //compute margins

    //Using these margins centers the image in the thumbnail.

    //If you always want the image to the top left, 

    //set both of these to 0

    $m_y = floor(($box_h - $sy) / 2);

    $m_x = floor(($box_w - $sx) / 2);



    //Copy the image data, and resample

    //

    //If you want a fast and ugly thumbnail,

    //replace imagecopyresampled with imagecopyresized

    if(!imagecopyresampled($new, $img,

        $m_x, $m_y, //dest x, y (margins)

        0, 0, //src x, y (0,0 means top left)

        $sx, $sy,//dest w, h (resample to this size (computed above)

        imagesx($img), imagesy($img)) //src w, h (the full size of the original)

    ) {

        //copy failed

        imagedestroy($new);

        return null;

    }

    return $new;

}

function getamentiesnameforproperty($conn,$id){


 
$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `amenties` where `id` ='$id'"));

	return $fetchRes[0];


}

function ephoto_color($oldname,$width,$height,$red,$green,$blue){
	if($oldname==''){
		 $oldname='property.png';	
		}
	 $imgName=$width."_".$height."_".$oldname;
	 $newname = "thumb/". $imgName;  
 if(!file_exists($newname)){
		$imgpath=$width."_".$height."_".$oldname;
		$size = getImageSize("photos/".$oldname);
		$w = $size[0];
		$h = $size[1];
		$img_type=$size[2];
		//die($img_type);
	switch($img_type) {
          case '1':
          $resimage = imagecreatefromgif("photos/".$oldname);
          break;
          case '2':
          $resimage = imagecreatefromjpeg("photos/".$oldname);
          break;
          case '3':
          $resimage = imagecreatefrompng("photos/".$oldname);
          break;
      }
	 $thumb = ephoto_boxs_color($resimage, $width, $height,$red,$green,$blue);
	 imagedestroy($resimage);
	if(is_null($thumb)) {
		header('HTTP/1.1 500 Internal Server Error');
		exit();
	}
	 imagejpeg($thumb,$newname);
	 	return  $imgName;	  
	}else{
		return  $imgName;	  
	}
}

function ephoto_boxs_color($img, $box_w, $box_h,$red,$green,$blue) {
    $new = imagecreatetruecolor($box_w, $box_h);
    if($new === false) {
        return null;
    }

    $fill = imagecolorallocate($new, $red, $green, $blue);
    imagefill($new, 0, 0, $fill);
    $hratio = $box_h / imagesy($img);
    $wratio = $box_w / imagesx($img);
    $ratio = min($hratio, $wratio);
    if($ratio > 1.0)
     $ratio = 1.0;

    $sy = floor(imagesy($img) * $ratio);
    $sx = floor(imagesx($img) * $ratio);
    $m_y = floor(($box_h - $sy) / 2);
    $m_x = floor(($box_w - $sx) / 2);
    if(!imagecopyresampled($new, $img,
        $m_x, $m_y, 
        0, 0,
        $sx, $sy,
        imagesx($img), imagesy($img))
    ) {
        imagedestroy($new);
       return null;
    }
    return $new;
}



function getlatestpropertyimage($conn,$pid){
	
	 $sqlQry=mysqli_query($conn,"select `imagepath` from `pimages` where `cid`='$pid' and `status`='1'");
	 
	$numrows=mysqli_num_rows($sqlQry);
	if($numrows>0){
		$fetchQry = mysqli_fetch_row($sqlQry);
		$image = $fetchQry[0];
	}else{
		$image=0;
	}
return $image;	
}

function getminpimagesproperty($conn,$pid)
{
$execQry=mysqli_query($conn,"select * from `pimages`  where `status`='1' and `cid`='$pid'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$quesids[]=$fetch['id'];
			
		}}

if(count($quesids)>0)
			{		
	$mincost=min($quesids);
}
else
{
	$mincost="0";
	}
return $mincost;
}

function getimageclient($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `imagepath` from `aboutus` where `id` ='$id'"));

	return $fetchRes[0];
}


function getcontentformid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `content` from `aboutus` where `id` ='$id'"));

	return $fetchRes[0];
}


function getminpropertyclassid($conn)
{
$execQry=mysqli_query($conn,"select * from `property`  where `status`='1'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$quesids[]=$fetch['id'];
			
		}}

if(count($quesids)>0)
			{		
	$mincost=min($quesids);
}
else
{
	$mincost="0";
	}
return $mincost;
}

function getfeaturedpropertymin($conn)
{
$execQry=mysqli_query($conn,"select * from `property`  where `status`='1' and `features`='1'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$quesids[]=$fetch['id'];
			
		}}

if(count($quesids)>0)
			{		
	$mincost=min($quesids);
}
else
{
	$mincost="0";
	}
return $mincost;
}

function getminhomebannerid($conn)
{
$execQry=mysqli_query($conn,"select * from `homebanner` where `status`='1'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$quesids[]=$fetch['id'];
			
		}}

if(count($quesids)>0)
			{		
	$mincost=min($quesids);
}
else
{
	$mincost="0";
	}
return $mincost;
}

function getrproductkeyword($conn,$id){
	$splypes=array();
	$execQry=mysqli_query($conn,"select * from `prokeyword` where `status` = '1' and `p_id`='$id' order by `id` desc");
	$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$splypes[]=$fetch['k_id'];
		}
	}else{
	}
	return $splypes;
}


function getcitynamenamebyid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `city` where `id` ='$id'"));

	return $fetchRes[0];
}
function getcountyidbyslug($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `county` where `slug` ='$id'"));

	return $fetchRes[0];
}
function getcountyslugbyid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `county` where `id` ='$id'"));

	return $fetchRes[0];
}


function getcountynamebyid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `county` where `id` ='$id'"));

	return $fetchRes[0];
}
function getpropertyforamebyid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `propertyfor` where `id` ='$id'"));

	return $fetchRes[0];
}

function getpropertyforidbyslug($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `propertyfor` where `slug` ='$id'"));

	return $fetchRes[0];
}


function getpropertyforslugbyid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `propertyfor` where `id` ='$id'"));

	return $fetchRes[0];
}


function getpropertynamefromid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `property` where `id` ='$id'"));

	return $fetchRes[0];
}
function getpropertytypenamefromid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `name` from `propertytype` where `id` ='$id'"));

	return $fetchRes[0];
}
function getpropertytypeslugfromid($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `propertytype` where `id` ='$id'"));

	return $fetchRes[0];
}

function getpropertytypeidfromslug($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `propertytype` where `slug` ='$id'"));

	return $fetchRes[0];
}


function getcityidfromslug($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `city` where `slug` ='$id'"));

	return $fetchRes[0];
}



function getpropertyidfromslug($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `property` where `slug` ='$id'"));

	return $fetchRes[0];
}

function getsociallinksagent($conn){


 
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `social` where  `id`='1'"));



	return $execQry;



}



function getcontactdetailsofagent($conn){


 
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `contact` where  `id`='1'"));



	return $execQry;



}
function getpropertydetailsbyid($conn,$id){


 
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `property` where  `id`='$id'"));



	return $execQry;



}

function getpropertydetailsbyidassoc($conn,$id){


 
	$execQry=mysqli_fetch_assoc(mysqli_query($conn,"select * from `mlspindata_master` where  `id`='$id'"));



	return $execQry;



}

function  activationText($email,$id,$baseurl){
$unText=" <a style='color:#FFFFFF;text-decoration:none' href ='".$baseurl."/changepassword.php?id=".base64_encode($id)."'>Change Password</a> ";
$msg='<head>
	<title>Newsletter Verification</title>
	</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;">
            	<tr>
                	<td align="center" valign="top" id="bodyCell" style="padding:20px 20px;">
                    	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
                        	<tr>
                            	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
                                	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="'.$baseurl.'/images/adminlogo.png" alt="Boshall" height=""  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
                                </td>    
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="padding-top:0px; padding-bottom:20px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
                                        <tr>
                                            <td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
                                                <h1 style="color:#606060 !important; font-family:Helvetica, Arial, sans-serif; font-size:40px; font-weight:bold; letter-spacing:-1px; line-height:115%; margin:0; padding:0; text-align:center;">Just one more step...</h1>
                                                <br />
                                               
                                                Click the big button below to change your password.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="middle" style="padding-right:40px; padding-bottom:40px; padding-left:40px;">
                                                <table border="0" cellpadding="0" cellspacing="0" class="emailButton" style="background-color:#6DC6DD; border-collapse:separate !important; border-radius:3px;">
                                                    <tr>
                                                        <td align="center" valign="middle" class="emailButtonContent" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:100%; padding-top:18px; padding-right:15px; padding-bottom:15px; padding-left:15px;">'.$unText.'</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top">
                                 	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailFooter">
                                    	<tr>
                                        	<td align="center" valign="top" class="footerContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:10px; line-height:125%;">
                                           The information contained in and accompanying this communication may be confidential, subject to legal privilege, or otherwise protected from disclosure, and is intended solely for the use of the intended recipient(s). 
                                                <br />
                                               
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="center" valign="top" style="padding-top:30px;">
                                            	<a style="color:#0073e6;text-decoration:none" href="'.$baseurl.'">Boshall</a>
                                            </td>
                                        </tr>
										   
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        </td>
                        </tr>
                        </table></body><html>';

return $msg;
}




function checkuserseekerCredentails($conn,$uname,$pwd){

	$username=mysqli_real_escape_string($conn,$uname);

	$pwd=md5($pwd);

	$selQry=mysqli_fetch_row(mysqli_query($conn,"select count(*)  from `user` where `status`='1' and `view`='1' and `mobile`='$username' and `password` ='$pwd'"));

	if($selQry[0]>0){

		return true	;

	}else{

		return false;	

	}

	

}
function getUpcomingEvents($conn){
$events=array();
$curDate=date("Y-m-d");
$curPreDate= maketime($curDate);
					 $pdate=date("Y-m-d");
					$selQry=mysqli_query($conn,"select *  from `events` where `status`='1' and `view`='1' and `sdate`>='$pdate' order by `id`  desc ");
	
					$numrows=mysqli_num_rows($selQry);
					if($numrows>0){
					while($fetch=mysqli_fetch_array($selQry))
					{
						$sdate=maketime($fetch['sdate']);
						$edatereq=$fetch['edaterequired'];
						$edate=  maketime($fetch['edate']);
						if($edatereq==0){
								$events[]=$fetch['id'];
						}elseif($edatereq==1){
							
							if($edate >= $curPreDate){
								$events[]=$fetch['id'];
							}
							
						}
					}
				}
return $events;
	
}

function maketime($date){
	
	
$expDob=explode("-",$date);
$expMonth=$expDob[1];	
$expDate=$expDob[2];
$expYear=$expDob[0];
$makedate=@mktime(0,0,0,$expMonth,$expDate,$expYear);
return 	$makedate;
}


function getUpcomingEventCategories($conn,$eids){
	
if(count($eids)>0){
	$impids=implode(",",$eids);
}else{
	$impids=0;
}
	$curDate=date("Y-m-d");

	$eventCategoriesArr=array();

	$selQry=mysqli_query($conn,"select *  from `events` where `id` in ($impids) limit 0,18");

					$numrows=mysqli_num_rows($selQry);

					if($numrows>0){

					while($fetch=mysqli_fetch_array($selQry)){

						$eventCategoriesArr[]=$fetch['cat_id'];

					}

					}

					$unqCat=array_unique($eventCategoriesArr);

					return $unqCat;

}
function thumbnailforworkshopbycat($conn,$oldname,$width,$height){
	echo "scsd";
if($oldname==''){
$oldname='nophoto.jpg';	
}
if(!file_exists($baseurl."/photos/".$oldname)){
$oldname='nophoto.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."/thumbnew/". $imgName;  
if(!file_exists($newname)){
$imgpath=$width."_".$height."_".$oldname;
$size = getImageSize($baseurl."/photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."/photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."/photos/".$oldname);
break;
}
$thumb = thumbnail_boxs($conn,$resimage, $width, $height);
imagedestroy($resimage);
if(is_null($thumb)) {
header('HTTP/1.1 500 Internal Server Error');
exit();
}
imagejpeg($thumb,$newname);
return  $imgName;	  
}else{
return  $imgName;	  
}
}



function thumbNailhelaer($oldname,$width,$height){

$imgName=$width."_".$height."_".$oldname;

$newname = "thumb/". $imgName;  

if(!file_exists($newname)){

$imgpath=$width."_".$height."_".$oldname;



$size = getImageSize("photos/".$oldname);

$w = $size[0];

$h = $size[1];

$img_type=$size[2];

//die($img_type);

switch($img_type) {

         case '1':

         $resimage = imagecreatefromgif("photos/".$oldname);

         break;

         case '2':

         $resimage = imagecreatefromjpeg("photos/".$oldname);

         break;

         case '3':

         $resimage = imagecreatefrompng("photos/".$oldname);

         break;

     }

$thumb = thumbnail_boxsnew($resimage, $width, $height);

imagedestroy($resimage);

if(is_null($thumb)) {

/* image creation or copying failed */

header('HTTP/1.1 500 Internal Server Error');

exit();

}

imagejpeg($thumb,$newname);

return  $imgName;	 



}else{

return  $imgName;	 



}

}
function thumbNailmagazinenewtest12($baseurl,$oldname,$width,$height){
if($oldname==''){
$oldname='healing-banner.jpg';	
}
if(!file_exists($baseurl."/photos/".$oldname)){
	
$oldname='healing-banner.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."/thumb/". $imgName;  
if(!file_exists($newname)){
$imgpath=$width."_".$height."_".$oldname;
$size = getImageSize($baseurl."/photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."/photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."/photos/".$oldname);
break;
}
$thumb = thumbnail_boxsnew($resimage, $width, $height);
imagedestroy($resimage);
if(is_null($thumb)) {
header('HTTP/1.1 500 Internal Server Error');
exit();
}
imagejpeg($thumb,$newname);
return  $imgName;	  
}else{
return  $imgName;	  
}
}





function updateNoticeVisibility($conn,$id,$type){
$execQry=mysqli_query($conn,"Update `requests`    set  `visible`='1' where `uid`='$id' and `type`='$type'  ");
}






function workshoplivenowmail($conn,$baseurl,$id){}



function backstrreplace($conn,$string){



//$str=preg_replace('/[^0-9a-zA-Z-]/'," ",$string);




$str=str_replace("-"," ",$string);



return $str;



}

function  mailforworshopsubmissiontohealer($baseurl,$expertname)
{}

function  mailcoontentforrecommendation1week($baseurl,$expertname)
{}


function getworkshopenquirystatus($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `status` from `eventhealerstatus` where `e_id` ='$id'"));

	return $fetchRes[0];
}

function getworkshopidformhealerinfo($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `eventid` from `eventhealerinfo` where `id` ='$id'"));

	return $fetchRes[0];
}



function  workshopinsrtmail($baseurl,$expertname,$seekername,$expertnumber,$calltime)
{
		
$msg='<head>

<title> Contacting our event facilitator '.$expertname.'</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="'.$baseurl.'/img/logo/logo.png" 	alt="LifePositive" height="167"  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
<h3 style="color:#fff !important; background:#0050a5; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Contacting our event facilitator ,'.$expertname.'. </h3>
<br />
<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">Hi '.$seekername.',</h3>

<br />
	<table width="100%" border="0">
 	 <tr>
     <td width="81%" align="left">We are excited to serve you. Please contact our expert, '.$expertname.', on <a href="tel:+91'.$expertnumber.'">+91'.$expertnumber.'</a>. Please note that our experts accept calls between '.$calltime.' (indian standard time) only, and if they are unable to attend to your call instantly, please leave a text message, and they will get back to you at the earliest.
<br/>
<br/>
With wishes for a life full of positivity,</td>


  </tr>

<br/>
 <tr style="text-align:left;">
	
	</tr
    ><tr style="text-align:left;">
	<td style="font-weight:bold;">Seeker Happiness Team @ Life Positive</td>
	</tr><tr style="text-align:left;">

	</tr>

 
</table>
</td>
</tr>
	
</table><table> <tr><td style="
    font-size:  15px;
    color: #6386ab;
">"This is a system generated email.Please do not  reply to this email."</td></tr>
</table></table></td></tr></table></body><html>
';

return $msg;

}

function  healernewno($baseurl,$expertname,$seekername,$expertnumber,$calltime)
{
	
$msg='<head>

<title> Contacting our expert '.$expertname.'</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="'.$baseurl.'/img/logo/logo.png" 	alt="LifePositive" height="167"  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
<h3 style="color:#fff !important; background:#0050a5; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Contacting our expert ,'.$expertname.'. </h3>
<br />
<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">Hi '.$seekername.',</h3>

<br />
	<table width="100%" border="0">
 	 <tr>
     <td width="81%" align="left">We are excited to serve you. Please contact our expert, '.$expertname.', on <a href="tel:+91'.$expertnumber.'">+91'.$expertnumber.'</a>. Please note that our experts accept calls between '.$calltime.' (indian standard time) only, and if they are unable to attend to your call instantly, please leave a text message, and they will get back to you at the earliest.
<br/>
<br/>
With wishes for a life full of positivity,</td>


  </tr>

<br/>
 <tr style="text-align:left;">
	
	</tr
    ><tr style="text-align:left;">
	<td style="font-weight:bold;">Seeker Happiness Team @ Life Positive</td>
	</tr><tr style="text-align:left;">

	</tr>

 
</table>
</td>
</tr>
	
</table><table> <tr><td style="
    font-size:  15px;
    color: #6386ab;
">"This is a system generated email.Please do not  reply to this email."</td></tr>
</table></table></td></tr></table></body><html>
';

return $msg;

}

function  mailforarticleworkshopsubmission($baseurl,$expertname)
{
	
$msg='<head>

<title> Hi '.$expertname.'</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="'.$baseurl.'/img/logo/logo.png" 	alt="LifePositive" height="167"  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
<h3 style="color:#fff !important; background:#0050a5; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Contacting our expert,'.$expertname.'. </h3>
<br />
<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">Hi '.$expertname.',</h3>

<br />
	<table width="100%" border="0">
 	 <tr>
     <td width="81%">Thank you for your submission!<br>We have received your request. Our Partner Experts Happiness team will review the submission within 72 working hours. Once the submission is approved, you will receive a notification

<br/>
With wishes for a life full of positivity,</td>


  </tr>

<br/>
 <tr style="text-align:left;">
	 
	</tr
    ><tr style="text-align:left;">
	<td style="font-weight:bold;">Seeker Happiness Team @ Life Positive</td>
	</tr><tr style="text-align:left;">
	
	</tr>

 
</table>
</td>
</tr>
	
</table><table> <tr><td style="
    font-size:  15px;
    color: #6386ab;
">"This is a system generated email.Please do not  reply to this email."</td></tr>
</table></table></td></tr></table></body><html>
';

return $msg;

}





function getuseridfromrecordidfromcallog($conn,$id)
{
	//echo "select `userid` from `eventhealerinfo` where `id` ='$id' and `status`='1'";
		$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `userid` from `eventhealerinfo` where `id` ='$id' and `status`='1'"));

	return $fetchRes[0];
	
	
}
function getminsessionfessfrommembeeridtodeduct($conn,$id)
{
$execQry=mysqli_query($conn,"select * from `memberprofession`  where `status`='1' and `mem_id`='$id'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$quesids[]=$fetch['cost'];
			
		}}

if(count($quesids)>0)
			{		
	$mincost=min($quesids);
}
else
{
	$mincost="0";
	}
return $mincost;
}

function getarchivecategoresfordisplaynew($conn)

{$execQry=mysqli_query($conn,"select * from `articles`  where `status`='1' and `view`='1' and `magazine_id`!='0' order by id");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$catid[]=$fetch['magazine_id'];
		
	}}
	if(count($catid)>0)
			{		
	$mincost=$catid;
}
else
{
	$mincost="0";
	}
return $mincost;
}


function sendworkshopticket($conn,$evntid,$firstname){
	
	$workshoparr=getEventDetailById($conn,$evntid);
	$eventname=$workshoparr[3];
	 $startdate=$workshoparr[11];
	 $startdate1=changeToStdDate($conn,$startdate);
	 $fees=$workshoparr[10];
	 if($fees!='0'){
		  $displayfees1=$workshoparr[10];
	  }else
		{$displayfees1='Free';}
	
	$msg='
	
	<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Workshop-'.$eventname.'</title>
<style>
.ticket {
    background: rgba(0, 0, 0, 0) url("https://www.lifepositive.com/img/ticket.png") repeat scroll 0 0 / cover ;
    height: 300px;
    width: 600px;
}
</style>
  
</head>

<body>
<div class="ticket">
	<div class="outer-detail" style="padding: 60px;">
    
    <div class="detail" style="width: 82%;padding: 20px 8px;">
    <h2 style="color: #2b2b2b;font-size: 16px;">'.$eventname.'</h2>
    <p style="margin: 4px 0;"><img src="https://www.lifepositive.com/img/rupee.svg" style="width: 15px;margin-right: 8px;">'.$displayfees1.'</p>
    <p style="margin: 4px 0;"><img src="https://www.lifepositive.com/img/calendar.svg" style="width: 15px;margin-right: 8px;">'.$startdate1.'</p>
    <p style="margin: 4px 0;"><img src="https://www.lifepositive.com/img/user.svg" style="width: 15px;margin-right: 8px;">'.$firstname.'</p>
    
    </div>
    
    <div class="logo">
    
    </div>
    
    
    </div>

</div>
  


</body>

</html>


';
return $msg;

	
	}

function getworshopcategoryforrevies($conn,$id)

{
	//echo $curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `events`  where `status`='1' and `view`='1' and `cat_id`='$id' ");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$eventid[]=$fetch['id'];
			
}

if(count($eventid)>0)
			{		
	$includedeventid=implode(",",$eventid);

}
else
{
	$includedeventid="0";
	}
	}
	else{$includedeventid="0";
	}

	return $includedeventid;
	
	}

function getmemberidforreviewworkshop($conn,$id)

{
	//echo $curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `events`  where `status`='1' and `view`='1' and `contributed`='$id' ");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$eventid[]=$fetch['id'];
			
}

if(count($eventid)>0)
			{		
	$includedeventid=implode(",",$eventid);

}
else
{
	$includedeventid="0";
	}
	}
	else{$includedeventid="0";
	}

	return $includedeventid;
	
	}



function getmemberidforreviewworkshopwithsdate($conn,$id)

{
	$curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `events`  where `status`='1' and `view`='1' and `contributed`='$id' and `sdate`>='$curDate'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$eventid[]=$fetch['id'];
			
}

	}
	
$includedeventid=count($eventid);
	return $includedeventid;
	
	}

function gethomepagecontent($conn,$id){
	

	$myquery=mysqli_query($conn,"select `meta_title` from `homesectioncontent` where `id` ='$id'");

	$result=mysqli_fetch_row($myquery);

return $result[0];


}

function getRightsById($conn,$aid){



$execQry=mysqli_query($conn,"select * from `rights` where `role_id` = '$aid'");



	$numRows=mysqli_num_rows($execQry);



	if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){



			$rightsid[]=$fetch['menu_id'];



		}



	}else{



			$rightsid[]=0;



	}



	return $rightsid;







}
function getmagpayid($conn,$id){

$val=1000+$id;

return "LPORDER".$val;

}
function getmagorderTxnId($conn,$id){

	$expId=explode("LPORDER",$id);

	$getId=$expId[1];

	$evtid=$getId-1000;

	return $evtid; 

}


function gettopId($conn,$id){

$val=1000+$id;

return "LPTH".$val;

}
//--- By Manisha---
function getcatidfromaid($conn,$oid){
  //echo "select `catid` from orders where `aid`='$oid' and `status`='1'";
$query=mysqli_query($conn,"select `catid` from orders where `id`='$oid' and `status`='1'");
$result=mysqli_fetch_row($query);
 
 return $result['0'];

}

function getidfromaid($conn,$oid){
  
$query=mysqli_query($conn,"select `id` from orders where `id`='$oid' and `status`='1'");
$result=mysqli_fetch_row($query);
 
 return $result['0'];

}
function getmemberidswherestatusisnotzero($conn){
  
$execQry=mysqli_query($conn,"select * from `members`  where `status`='1' and `view`='1'");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$memberid[]=$fetch['id'];
			
		}}

if(count($memberid)>0)
			{		
$mids=implode(",",$memberid);
}
else
{
	$mids="0";
	}
return $mids;
}
function getworkshopbudgetfromid($conn,$id){
	
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `workshopbudget` where `id`='$id' and `status`='1'"));

	return $fetchRes;

}
function geteorkshopreversestatus($conn,$id){
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `eventhealerstatus` where `e_id`='$id'"));

	return $fetchRes;

}
function getcallexpertstatusreverse($conn,$id){
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `sessionstatus` where `qid`='$id'"));

	return $fetchRes;

}



function getnewshoppingcartbyaid($conn,$id){
 $query="select * from `newshoppingcart` where `catid` <> 0 and `aid`='$id'";
$query1=mysqli_query($conn,$query);
$fetch=mysqli_fetch_array($query1);
return $fetch;

}

function gettotalsubuser($conn){
  $query="select * from `newshoppingcart` where `catid` <> 0 ";
$query1=mysqli_query($conn,$query);
$total_suser=mysqli_num_rows($query1);
return $total_suser;
}

function getsubsorderid($conn){
  $query="select * from `newshoppingcart` where `catid` <> 0 ";
$query1=mysqli_query($conn,$query);
$total_suser=mysqli_num_rows($query1);
if($total_suser>0){
  while($fetch_uid=mysqli_fetch_array($query1)){
   
    $uid[]=$fetch_uid['aid'];
  }
  $tot_uid=implode(",", $uid);
}
return $tot_uid;
}
//-----------------------------
function checkifarticleisrecommended($conn,$raid)
{


$myquery=mysqli_query($conn,"select `recommendedapp` from `wellness` where `id`='$raid'");

$result=mysqli_fetch_row($myquery);

return $result[0];
}

function getbasectgnamebyd($conn,$id){

$sqlQry=mysqli_query($conn,"select `name` from `basemang` where `id` ='$id'");
	//echo "select `name` from `basemng` where `id` ='$id'";
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getEventenrolmentDetailById($conn,$id){
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `eventenrollment` where `id` ='$id'  "));

	return $fetchRes;

}
function getmemberbasefeeDetailById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `basepay` where `id` ='$id'  "));

	return $fetchRes;

}

function getworkshopcreditdeductionamount($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `creditdeductionforworkshop` where `e_id` ='$id'  "));

	return $fetchRes;

}
function getworkshopcreditdeductionamountcreditpay($conn,$id){

$sqlQry=mysqli_query($conn,"select `amount` from `creditdeductionforworkshop` where `creditpayid` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];	

}

function geteidfromcreditworkhopo($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `e_id` from `creditdeductionforworkshop` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function geteventhealerinfotabledata($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `eventhealerinfo` where `id` ='$id' and `status`='1' "));

	return $fetchRes;

}

function getlistingvisitnumberfromprofessionid($conn,$id){

	$fetchRes=mysqli_query($conn,"select `count` from `listingvisit` where `profid` ='$id' and `status`='1' ");
$numrows=mysqli_fetch_row($fetchRes);

	return $numrows[0];

}


function getlistingvisitnumbercountfromprofessionid($conn,$id){

	$fetchRes=mysqli_query($conn,"select `count` from `listingvisit` where `profid` ='$id' and `status`='1' ");
$numrows=mysqli_fetch_row($fetchRes);

	return $numrows[0];

}
function getallcasesfrommemberid($conn,$id){

	$fetchRes=mysqli_query($conn,"select * from `eventhealerinfo` where `healerid` ='$id' and `eventid`='0'");
	$numrows=mysqli_num_rows($fetchRes);
	if($numrows>0)
	{
while($results=mysqli_fetch_array($fetchRes))
{
	$allcaseids[]=$results['id'];
	
	
}
	}
	else
	{
		$allcaseids="";
		
		
	}
	return $allcaseids;

}

function getallcasescount_frommemberid($conn,$id){
	//echo "select * from `eventhealerinfo` where `healerid` ='$id' and `eventid`='0' ";
	$fetchRes=mysqli_query($conn,"select * from `eventhealerinfo` where `healerid` ='$id' and `eventid`='0' ");
	$numrows=mysqli_num_rows($fetchRes);
	
	return $numrows;

}

function getBaseId($conn,$id){

	$val=1000+$id;

	return "LFWRB".$val;

}

function getmemberidbytexnid($conn,$id){

$sqlQry=mysqli_query($conn,"select `memberid` from `basepay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}


function getpdate($conn,$id){

$sqlQry=mysqli_query($conn,"select `pdate` from `basepay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getbaseTxnId($conn,$id){

	$expId=explode("LFWRB",$id);

	$getId=$expId[1];

	$evtid=$getId-1000;

	return $evtid; 

}



function getfilledseatsofevents($conn,$eventid){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `filledseats` from `events` where `id` ='$eventid'"));

return $fetchRes[0];	

	

	}


function get_youtube_image($conn,$url = '', $type = '3' ) {
if( empty( $url ) )
    return false;
if( !isset( $type ) )
    $type = '';
preg_match("|[\\?&]v=([^&#]*)|",$url,$vid_id);
if( !isset( $vid_id[1] ) )
    return false;
$img_server_num =  'i'. rand(1,4);
switch( $type ) {



    case '0':



        $img_link = "https://{$img_server_num}.ytimg.com/vi/{$vid_id[1]}/0.jpg";



        break;



    case '1':
$img_link = "https://{$img_server_num}.ytimg.com/vi/{$vid_id[1]}/1.jpg";

 break;



    case '2':
 $img_link = "https://{$img_server_num}.ytimg.com/vi/{$vid_id[1]}/2.jpg";



        break;
case '':



    default:



        $img_link = "http://{$img_server_num}.ytimg.com/vi/{$vid_id[1]}/default.jpg";



        break;
}

return $img_link;
}

function getEventsluggByid($conn,$eventid){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `events` where `id` ='$eventid'"));

return $fetchRes[0];	

	

	}


function getbaseservicetax($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `amount` from `baseservicetax` where `id` ='1' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getalleventoffers($conn,$id){
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `eventoffers` where `e_id` ='$id' and `status`='1'"));

	return $fetchRes;

}



function getworkshopstar($conn,$eventid)
{ $reviewquery=mysqli_query($conn,"select * from `eventrating` where `event_id`='$eventid' and `status`='1' and `view`='1'");
							
							$numre=mysqli_num_rows($reviewquery);
							
		
		while($fetch=mysqli_fetch_array($reviewquery)){



			$profypes[]=$fetch['star'];



		}
		//print_r($profypes);
					
	 $starcount=array_sum($profypes);
	
	$average=$starcount/$numre;
	
	return $average;
	
	
}



function createthumbnailforeventsworkshop($oldname,$width,$height,$baseurl){

if($oldname==''){



 $oldname='nophoto.jpg';	



}



 if(!file_exists($baseurl."/photos/".$oldname)){



   $oldname='nophoto.jpg';



  }

  

   

  



	$imgName=$width."_".$height."_".$oldname;



  







	$newname = $baseurl."/thumb/". $imgName;

	

	

	   if(!file_exists($newname)){

	

	$thumbw = $width;



	$thumbh = $height;



	$nh = $thumbh;



	$nw = $thumbw;



	$size = getImageSize($baseurl."/photos/".$oldname);



	$w = $size[0];



	$h = $size[1];



	$img_type=$size[2];



	$ratio = $h / $w;



	$nratio = $nh / $nw; 







  if($ratio > $nratio)



  {



    $x = intval($w * $nh / $h);



    if ($x < $nw)



    {



      $nh = intval($h * $nw / $w);



    } 



    else



    {



      $nw = $x;



    }



  }



  else



  {



    $x = intval($h * $nw / $w);



    if ($x < $nh)



    {



      $nw = intval($w * $nh / $h);



    } 



    else



    {



      $nh = $x;



    }



  }  



	



		



		//die($img_type);



	switch($img_type) {



          case '1':



          $resimage = imagecreatefromgif($baseurl."/photos/".$oldname);



          break;



          case '2':



          $resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);



          break;



          case '3':



          $resimage = imagecreatefrompng($baseurl."/photos/".$oldname);



          break;



      }







  //$resimage = imagecreatefromjpeg($oldname); 



  $newimage = imagecreatetruecolor($nw, $nh);  



  // use alternate function if not installed



  imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);



  



  // Making the final cropped thumbnail



  



  $viewimage = imagecreatetruecolor($thumbw, $thumbh);



  imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);



  



  // saving



  imagejpeg($viewimage, $newname, 85);







	return $imgName;

	   }else{

	return $imgName;   

	}

}
function getseodetail($conn,$id){
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `seomanage` where `id` ='$id'  "));

	return $fetchRes;

}




function getEventDetailById($conn,$id){
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `events` where `id` ='$id'  "));

	return $fetchRes;

}

function getmailernumber($conn,$id){

$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `contact` from `mailnumbers` where `id`='$id' "));

return $fetchRes[0];	

	

}


function getEventIdByslug($conn,$slug){

$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `events` where `slug` ='$slug' and `view`='1' and `status`='1' "));

return $fetchRes[0];	

	

}

function createThumbNailtest($conn,$oldname,$width,$height){
if($oldname==''){
$oldname='nophoto.jpg';	
}
if(!file_exists($baseurl."photos/".$oldname)){
$oldname='nophoto.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."thumb/". $imgName;  
if(!file_exists($newname)){
$imgpath=$width."_".$height."_".$oldname;
$size = getImageSize($baseurl."photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."photos/".$oldname);
break;
}
$thumb = thumbnail_boxs($conn,$resimage, $width, $height);
imagedestroy($resimage);
if(is_null($thumb)) {
header('HTTP/1.1 500 Internal Server Error');
exit();
}
imagejpeg($thumb,$newname);
return  $imgName;	  
}else{
return  $imgName;	  
}
}



function createThumbNailtest1($conn,$oldname,$width,$height,$baseurl){
	echo $oldname;
if($oldname==''){



 $oldname='nophoto.jpg';	



}

echo $oldname;

 if(!file_exists($baseurl."/photos/".$oldname)){



   $oldname='nophoto.jpg';



  }

  

   

  



	 $imgName=$width."_".$height."_".$oldname;



  







	$newname = $baseurl."/thumb/". $imgName;

	

	

	   if(!file_exists($newname)){

	

	$thumbw = $width;



	$thumbh = $height;



	$nh = $thumbh;



	$nw = $thumbw;



	$size = getImageSize($baseurl."/photos/".$oldname);



	$w = $size[0];



	$h = $size[1];



	$img_type=$size[2];



	$ratio = $h / $w;



	$nratio = $nh / $nw; 







  if($ratio > $nratio)



  {



    $x = intval($w * $nh / $h);



    if ($x < $nw)



    {



      $nh = intval($h * $nw / $w);



    } 



    else



    {



      $nw = $x;



    }



  }



  else



  {



    $x = intval($h * $nw / $w);



    if ($x < $nh)



    {



      $nw = intval($w * $nh / $h);



    } 



    else



    {



      $nh = $x;



    }



  }  



	



		



		//die($img_type);



	switch($img_type) {



          case '1':



          $resimage = imagecreatefromgif($baseurl."/photos/".$oldname);



          break;



          case '2':



          $resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);



          break;



          case '3':



          $resimage = imagecreatefrompng($baseurl."/photos/".$oldname);



          break;

		

      }







  //$resimage = imagecreatefromjpeg($oldname); 



  $newimage = imagecreatetruecolor($nw, $nh);  



  // use alternate function if not installed



  imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);



  



  // Making the final cropped thumbnail



  



  $viewimage = imagecreatetruecolor($thumbw, $thumbh);



  imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);



  



  // saving



  imagejpeg($viewimage, $newname, 85);







	return $imgName;

	   }else{

	return $imgName;   

	}

}



function shortlistedworkshop($conn,$userid,$contype,$eventid)
{
	$execQry=mysqli_query($conn,"select * from `workshopwishlist` where `uid` ='$userid' and `ctype`='$contype' and `eventid`='$eventid'");
$numrows=mysqli_num_rows($execQry);
if($numrows==0)
{
return '0';	
	
	
}

else
{
	
return '1';	
	
}

}

function createphotosthumbnail($conn,$oldname,$width,$height,$baseurl){

 	$imgName=$width."_".$height."_".$oldname;
	$newname = $baseurl."/photos/". $imgName;
   if(!file_exists($newname)){
	$thumbw = $width;
	$thumbh = $height;
	$nh = $thumbh;
	$nw = $thumbw;
	$size = getImageSize($baseurl."/photos/".$oldname);
	$w = $size[0];
	$h = $size[1];

	$img_type=$size[2];

	$ratio = $h / $w;
	$nratio = $nh / $nw; 

  if($ratio > $nratio)
	{
    $x = intval($w * $nh / $h);
    if ($x < $nw)

    {

      $nh = intval($h * $nw / $w);

    } 
else
    {
      $nw = $x;
    }
  }
  else
  {
    $x = intval($h * $nw / $w);
    if ($x < $nh)
    {
      $nw = intval($w * $nh / $h);
    } 
    else
    {
      $nh = $x;
    }
} 
  switch($img_type) {
		
			case '1':
          $resimage = imagecreatefromgif($baseurl."/photos/".$oldname);
          break;



          case '2':
          $resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);
          break;



          case '3':
          $resimage = imagecreatefrompng($baseurl."/photos/".$oldname);
          break;
      }
$newimage = imagecreatetruecolor($nw, $nh);  
imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);
$viewimage = imagecreatetruecolor($thumbw, $thumbh);
imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);
imagejpeg($viewimage, $newname, 85);
return $imgName;

	   }else{

	return $imgName;   

	}

}







function createworkshopimages($conn,$oldname,$width,$height,$baseurl){

 	$imgName=$width."_".$height."_".$oldname;
	$newname = $baseurl."/thumb/". $imgName;
   if(!file_exists($newname)){
	$thumbw = $width;
	$thumbh = $height;
	$nh = $thumbh;
	$nw = $thumbw;
	$size = getImageSize($baseurl."/photos/".$oldname);
	$w = $size[0];
	$h = $size[1];

	$img_type=$size[2];

	$ratio = $h / $w;
	$nratio = $nh / $nw; 

  if($ratio > $nratio)
	{
    $x = intval($w * $nh / $h);
    if ($x < $nw)

    {

      $nh = intval($h * $nw / $w);

    } 
else
    {
      $nw = $x;
    }
  }
  else
  {
    $x = intval($h * $nw / $w);
    if ($x < $nh)
    {
      $nw = intval($w * $nh / $h);
    } 
    else
    {
      $nh = $x;
    }
} 
  switch($img_type) {
		
			case '1':
          $resimage = imagecreatefromgif($baseurl."/photos/".$oldname);
          break;



          case '2':
          $resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);
          break;



          case '3':
          $resimage = imagecreatefrompng($baseurl."/photos/".$oldname);
          break;
      }
$newimage = imagecreatetruecolor($nw, $nh);  
imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);
$viewimage = imagecreatetruecolor($thumbw, $thumbh);
imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);
imagejpeg($viewimage, $newname, 85);
return $imgName;

	   }else{

	return $imgName;   

	}

}






function getworkshopvideo($conn,$id){

$execQry=mysqli_query($conn,"select `path` from `eventvideos` where `event_id`='$id' ");



	$fetchRes=mysqli_fetch_row($execQry);



	return $fetchRes[0];



}



function thumbNailforworkshop($conn,$oldname,$width,$height){
if($oldname==''){
$oldname='nomag.jpg';	
}
if(!file_exists($baseurl."photos/".$oldname)){
$oldname='nomag.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."thumb/". $imgName;  
if(!file_exists($newname)){
$imgpath=$width."_".$height."_".$oldname;
$size = getImageSize($baseurl."photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."photos/".$oldname);
break;
}
$thumb = thumbnail_boxs($conn,$resimage, $width, $height);
imagedestroy($resimage);
if(is_null($thumb)) {
header('HTTP/1.1 500 Internal Server Error');
exit();
}
imagejpeg($thumb,$newname);
return  $imgName;	  
}else{
return  $imgName;	  
}
}

function thumbnail_boxsdsfg($conn,$img, $box_w, $box_h) {



    $new = imagecreatetruecolor($box_w, $box_h);



    if($new === false) {



        return null;



    }
    $fill = imagecolorallocate($new, 255,255,255);
    imagefill($new, 0, 0, $fill);
    $hratio = $box_h / imagesy($img);
    $wratio = $box_w / imagesx($img);
    $ratio = min($hratio, $wratio);

    if($ratio > 1.0)



        $ratio = 1.0;


  $sy = floor(imagesy($img) * $ratio);



    $sx = floor(imagesx($img) * $ratio);



    $m_y = floor(($box_h - $sy) / 2);



    $m_x = floor(($box_w - $sx) / 2);




    if(!imagecopyresampled($new, $img,



        $m_x, $m_y, //dest x, y (margins)



        0, 0, //src x, y (0,0 means top left)



        $sx, $sy,//dest w, h (resample to this size (computed above)



        imagesx($img), imagesy($img)) //src w, h (the full size of the original)



    ) {



        //copy failed



        imagedestroy($new);



        return null;



    }



    return $new;



}

function getmemberidsallforworkshopnew($conn)

{
	//echo $curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `events`  where `status`='1' and `view`='1' and `contributed`!='0' ");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			
			$catid[]=$fetch['contributed'];
		


$unqCat=array_unique($catid);
	}}
	return $unqCat;
	
	}
function getcategoriesforworkshopnew($conn)

{
	//echo $curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `events`  where `status`='1' and `view`='1' order by rand(),id");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			if($fetch['cat_id']!='0'){
			$catid[]=$fetch['cat_id'];
		
			}

$unqCat=array_unique($catid);
	}}
	return $unqCat;
	
	}

function getcategoriesforworkshop($conn)

{
	//echo $curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `events`  where `status`='1' and `view`='1' ");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			if($pdate<=$curDate){
			$catid[]=$fetch['cat_id'];
			
}}

if(count($catid)>0)
			{		
	$includedcatid=implode(",",$catid);

}
else
{
	$includedcatid="0";
	}
	}
	else{$includedcatid="0";
	}

	return $includedcatid;
	
	}



function getarticlescountbymemid($conn,$conId)
{
	$exqry=mysqli_query($conn,"select * from  `wellness` where `status`='1' and `view`='1' and `contributed`='$conId' ");
	$numrows=mysqli_num_rows($exqry);
	
	return $numrows;
	
}

function getAdminEmail($conn){



	$sqlQry=mysqli_query($conn,"select `email` from `admin` where `id`='1'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry[0];
 


}





function addnotice($conn,$msg){
    $pdate=date("d F, Y");
	$msg=mysqli_real_escape_string($conn,$msg);
	mysqli_query($conn,"Insert into `notices` set `notice`='$msg' ,`pdate`='$pdate',`visible`='0'");
	//$to=getAdminEmail($conn);
//	$from='support@thesilverlining.co.in';
//	$fromname="LifePositive";
//	$subject="New Activity @LifePositive";
//	sendBasicMail($to,$from,$fromname,$subject,$msg);

}


function getAdminNameById($conn,$id){







	$execQry=mysqli_query($conn,"select `username` from `admin` where `id`='$id' ");



	$fetchRes=mysqli_fetch_row($execQry);



	return $fetchRes[0];



}



function getNotVisibleNotices($conn){



   $execQry=mysqli_query($conn,"select * from `notices`    where `visible`='0' order by `id` desc ");



   $numRows=mysqli_num_rows($execQry);




   return $numRows;



}
function getNotVisibleurlNotices($conn){



   $execQry=mysqli_query($conn,"select * from `urlnotices`    where `visible`='0' order by `id` desc ");



   $numRows=mysqli_num_rows($execQry);




   return $numRows;



}


function changeDateFormatnew23($conn,$date){
$expDob=explode("-",$date);
$expMonth=$expDob[1];	
$expDate=$expDob[2];
$expYear=$expDob[0];
$makedate=$expMonth."/".$expDate."/".$expYear;
return 	$makedate;
}


function getConsultantIdBySlug($conn,$slug){



	$slug=trim($slug);



	$query=mysqli_query($conn,"select `id` from `members` where `slug`='$slug'");



	$numRows=mysqli_num_rows($query);



	if($numRows>0){



		$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `id` from `members` where `slug`='$slug'"));



		return $resultSet[0];



	}else{



	    return '0';



	



	}



}


function getProfessionIdByTSlug($conn,$slug){

	$slug=trim($slug);
	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `id` from `books` where `titleslug`='$slug' and `status` ='1' and `view`='1'" ));


	return 	$resultSet[0];



}




function getProfessionIdBySlug($conn,$slug){


	$slug=trim($slug);
	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `id` from `books` where `slug`='$slug' and `status` ='1' and `view`='1'" ));


	return 	$resultSet[0];



}


function checkSessionisActive($conn,$session){

	//$username=mysql_real_escape_string($uname);



	$selQry=mysqli_fetch_row(mysqli_query($conn,"select `status`  from `sessions` where  `id`='$session'  "));

	

		return $selQry[0]	;

	


	


}
function getSpecializationNameById($conn,$id){



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `specials` where `id`='$id'"));



	return $resultSet[1];



}



function getConsultantprofession($conn,$cid){



	$profypes=array();



	$execQry=mysqli_query($conn,"select * from `memberprofession` where `status` = '1' and `mem_id`='$cid' order by `main` desc");



	 $numRows=mysqli_num_rows($execQry);



	if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){



			$profypes[]=$fetch['prof_id'];



		}



	}else{



	}



	//$sessIds=getConsultantSessionTypeNames($sessiontypes);



	return $profypes;



}




function getConsultantProfessionById($conn,$id){



	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `profession` from `members` where  `id`='$id' and `status`='1'  "));



	return getProfessionNameById($conn,$execQry[0]);



}
function getEventStartdateById($conn,$eid){



	$curdate=date("Y-m-d");	



	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `sdate` from `events` where `id`='$eid' "));



	return changeToStdDate($conn,$execQry[0]);







}

function getEventcontributineById($conn,$eid){


	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `contributed` from `events` where `id`='$eid' "));


	return $execQry[0];
}

function getEventNameById($conn,$eid){


	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `title` from `events` where `id`='$eid' "));


	return $execQry[0];
}

function getOnlineLocationNameById($conn,$bid){



	$selQry=mysqli_fetch_row(mysqli_query($conn,"select `name`  from `onlineeventlocation` where `id`='$bid' "));

	return $selQry[0];

}

function getEventId($conn,$id){

	$val=1000+$id;

	return "LPEV".$val;

}
function getArchiveid($conn,$id){

	$val=1000+$id;

	return "LPARC".$val;

}

function coloredheartfromuidandcon($conn,$userid,$contype,$aid)
{
	
	$execQry=mysqli_query($conn,"select * from `userlikes` where `userid` ='$userid' and `contype`='$contype' and `articleid`='$aid'");
$numrows=mysqli_num_rows($execQry);
if($numrows==0)
{
return '0';	
	
	
}

else
{
	
return '1';	
	
}

}

function getwellnessnewdata($conn,$id){

$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `wellness` where `id`='$id'"));

	return $fetchRes;
}

function gethealergallery($conn,$id){

$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `healergallery` where `id`='$id'"));

	return $fetchRes;
}

function getWellnessDetailsbyid($conn,$id){
	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `wellness` where `id`='$id'"));
	return $resultSet;
}

function getProfessionNameById($conn,$id){



	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `title` from `books` where  `id`='$id'  "));



	return $execQry[0];



	



}
function getmagzinefinalpricefromshopingcart($conn,$id,$pid) 
{
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `price` from `newshoppingcart` where `aid`='$id' and `pid`='$pid'"));
return $fetchRes[0];
}

function html2text($conn,$html)



{



    $tags = array (



    0 => '~<h[123][^>]+>~si',



    1 => '~<h[456][^>]+>~si',



    2 => '~<table[^>]+>~si',



    3 => '~<tr[^>]+>~si',



    4 => '~<li[^>]+>~si',



    5 => '~<br[^>]+>~si',



    6 => '~<p[^>]+>~si',



    7 => '~<div[^>]+>~si',



    );



    $html = preg_replace($tags,"\n",$html);



    $html = preg_replace('~</t(d|h)>\s*<t(d|h)[^>]+>~si',' - ',$html);



    $html = preg_replace('~<[^>]+>~s','',$html);



    // reducing spaces



    $html = preg_replace('~ +~s',' ',$html);



    $html = preg_replace('~^\s+~m','',$html);



    $html = preg_replace('~\s+$~m','',$html);



    // reducing newlines



    $html = preg_replace('~\n+~s',"\n",$html);



    return $html;



}

function checkUserExists($conn,$email){







	$execQry=mysqli_fetch_row(mysqli_query($conn,"select count(*) from `user` where `email` = '$email' "));



	$num= $execQry[0];



	if($num>0){



	return true;



	}else{



	return false;



	}



}

function getCityNameById($conn,$id){



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `city` where `id`='$id'"));



	return $resultSet[1];



}
function getstateidbynamenew($conn,$id){

$sqlQry=mysqli_query($conn,"select `id` from `state` where `name`='$id'");
$fetchQry=mysqli_fetch_row($sqlQry);
return stripslashes($fetchQry[0]);

}
function getcityidbynamenew($conn,$id){

$sqlQry=mysqli_query($conn,"select `id` from `city` where `name`='$id'");
$fetchQry=mysqli_fetch_row($sqlQry);
return stripslashes($fetchQry[0]);

}

function getStateNameById($conn,$id){



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `state` where `id`='$id'"));



	return $resultSet[1];



}
function getStateIdByCityId($conn,$id){



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `city_state` from `cities` where `city_id`='$id'"));



	return $resultSet[0];



}

function getToolsPractisedByArr($conn,$tools){



foreach($tools as $profid){

	

$professionName[]=	getProfessionNameById($conn,$profid);

}

$text=implode(",",$professionName);

	return $text;

}



function getCode($conn,$id){


 
	$val=1000+$id;



	return "LP".$val;



}
function getStatus($conn,$value){


	if($value==1){



		return '<span class="label label-success">Approved</span>';



	}



	if($value==0){



		return '<span class="label label-danger">Blocked</span>';



	}



}
function getSiteTitle($conn){

$sqlQry=mysqli_query($conn,"select `site_name` from `generalsettings` where `id`='1'");
$fetchQry=mysqli_fetch_row($sqlQry);
echo stripslashes($fetchQry[0]);

}
function getlifepositiveontactnumber($conn){

$sqlQry=mysqli_query($conn,"select `contact` from `generalsettings` where `id`='1'");
$fetchQry=mysqli_fetch_row($sqlQry);
return stripslashes($fetchQry[0]);

}

function checkIntrusion($conn,$uid){



	if($uid=='' ){


echo $baseurl."/adboshall";
	header("location:index.php");



	exit;



	}



}


function getMenuNameById($conn,$id){



	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `category` from `menucategory` where `id`='$id' "));



	return $execQry[0];



}


function getMainMenusByRights($conn,$ridArr){



	    $impIds=implode(",",$ridArr);



		$execQry=mysqli_query($conn,"select `c_id` from `menusubcategory` where `id` IN ( $impIds )");



		$numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){



			$menuids[]=$fetch['c_id'];



		}



		}else{



			$menuids[]=0;



		}



	return $menuids;



}
function getAdminRoleById($conn,$id){



	$sqlQry=mysqli_query($conn,"select `role_id` from `admin` where `id`='$id'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry[0];



}


function getRoleBasedRights($conn,$rid){



		$execQry=mysqli_query($conn,"select `menu_id` from `rights` where `role_id`='$rid'");



		$numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){



			$menuids[]=$fetch['menu_id'];



		}



		}else{



			$menuids[]=0;



		}



	return $menuids;



}


function getAdminKey($conn,$aid){



	$sqlQry=mysqli_query($conn,"select `skey` from `admin` where `id`='$aid'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry[0];



}

function getCurentUrlFromScriptName($conn,$file){



$break = explode('/', $file);



$pfile = $break[count($break) - 1]; 



$sqlQry=mysqli_query($conn,"select `c_id` from `menusubcategory` where `link`='$pfile'");



$numRows=mysqli_num_rows($sqlQry);



if($numRows==0){



	return '0';



}else{



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `c_id` from `menusubcategory` where `link`='$pfile'"));



	return $resultSet[0];



}



//return $pfile;



}



function changeDateFormat($conn,$date){
$expDob=explode("-",$date);
$expMonth=$expDob[1];	
$expDate=$expDob[0];
$expYear=$expDob[2];
$makedate=$expYear."-".$expMonth."-".$expDate;
return 	$makedate;
}

function getSpecializationSlugById($conn,$id){

$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `slug`,`name` from `specials` where `id`='$id'"));
if( $resultSet[0]==''){
return 	strtolower(strreplace($conn,$resultSet[1]));	



	}else{



		return 	$resultSet[0];



	}



}
function getProfessionSlugById($conn,$id){



	$slug=trim($slug);



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `slug`,`title` from `books` where `id`='$id'"));



	if( $resultSet[0]==''){



		return 	strtolower(strreplace($conn,$resultSet[1]));	



	}else{



		return 	$resultSet[0];



	}



}

function getProfessionTSlugById($conn,$id){



	$slug=trim($slug);



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `titleslug`,`title` from `books` where `id`='$id'"));



	if( $resultSet[0]==''){



		return 	strtolower(strreplace($conn,$resultSet[1]));	



	}else{



		return 	$resultSet[0];



	}



}
function getConsultantSlugById($conn,$id){
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `members` where `id` ='$id' "));

$numrows=mysqli_num_rows($fetchRes);
if($fetchRes[0]!="")
{
	$name= $fetchRes[0];

}

else
{
	$name=strtolower(strreplace($conn,$fetchRes[0]));

	$fetchRes=mysqli_query($conn,"insert into `members` set `slug`='$name' where `id` ='$id' ");
	
	
}

	return $name;	

	
	}

function getMemberMobileNumber($conn,$id){



	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `pcontact` from `members` where `id` ='$id' "));



	$name= trim($fetchRes[0]);



	return $name;	



}


function getUserMobileNumber($conn,$id){

//echo "select `mobile` from `user` where `id` ='$id'";

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `mobile` from `user` where `id` ='$id' "));



	$name= $fetchRes[0];



	return $name;	



}


function getUseridfromMobileNumber($conn,$id){

//echo "select `mobile` from `user` where `id` ='$id'";

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `user` where `mobile` ='$id' "));



	$name= $fetchRes[0];



	return $name;	



}

function getUserEmail($conn,$id){



	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `email` from `user` where `id` ='$id' "));



	$name= $fetchRes[0];



	return $name;	



}


function limitContent($conn,$title,$value){



if(strlen($title)>$value){



	$content=substr($title,0,$value).". . .";



}else{



     $content=$title;







}



return $content;



}


function changeToStdDate($conn,$date){



$expDate=explode("-",$date);



$monthText=getShortMonth($conn,$expDate[1]-1);



$newDate=$expDate[2]." ".$monthText.", ".$expDate[0];



return $newDate;



}



function getShortMonth($conn,$val){



$monthArr=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");



return $monthArr[$val];



}



function getFullMonth($conn,$val){



$monthArr=array("January","Febuary","March","April","May","June","July","August","September","October","November","December");



return $monthArr[$val];



}	



function changeDate($conn,$date){



    $expDob=explode("/",$date);



	$expMonth=$expDob[1];	



	$expDate=$expDob[0];



	$expYear=$expDob[2];



	$makedate=$expYear."-".$expMonth."-".$expDate;



	return 	$makedate;



	



}


function getTabledataById($conn,$col,$table,$id){



	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `$col` from `$table` where `id`='$id' "));



	return 	$execQry[0];



}
function getcreditTxnId($conn,$id){

	$expId=explode("LPCREDIT",$id);

	$getId=$expId[1];

	$evtid=$getId-1000;

	return $evtid; 

}


function  basefeepaymentduemembermail($conn,$baseurl,$membername)
{
	$shortUrl=$baseurl."/experts-signin";
$msg='<head>


<title>Quarterly Payment Alert</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="https://www.lifepositive.com/img/logo/logo.png" 	alt="Life Positive" height=""  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
<h3 style="color:#fff !important; background:#aa1e21; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Quarterly Payment </h3>
<br />
<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">'.$membername.'</h3>

<br />
	<table width="100%" border="0">
 	 <tr style="text-align:center;"><td width="81%">It looks like your quarterly base energy exchange payment is due. Please make this payment at the earliest by visiting your dashboard HERE '.$shortUrl.'</td>
</tr>


 <tr style="text-align:Center;">
	<td style="font-weight:bold;">Thankyou!</td>
	
</tr>

 
</table>
</td>
</tr>
	<tr>



                              <td align="center" valign="middle" style="padding-right:40px; padding-bottom:10px; padding-left:40px;">
<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style="border-collapse:separate !important; border-radius:3px;">
<tr>
<td>For any queries please contact :'.getAdminPhoneNumber($conn).' or drop a mail at '.getAdminDisplayEmail($conn).'</td><tr>

             </table>
			</td>
		    </tr>
		    </table>
			</td>
			</tr>
			<tr>
			<td align="center" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailFooter">
		<tr>
<td align="center" valign="top" class="footerContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:125%;">"This is a system generated email.Please do not  reply to this email."<br/>
The information contained in and accompanying this communication may be confidential, subject to legal privilege, or otherwise protected from disclosure, and is intended solely for the use of the intended recipient(s). 

</td>
 </tr>
<tr>
<td align="center" valign="top" style="padding-top:10px;">
<a style="color:#0073e6;text-decoration:none" href="'.$baseurl.'">lifepositive.com</a>
</td>
 </tr>
<tr>
<td align="center" valign="top" style="padding-top:0px;color:#f2f2f2;">'.date("h:m:i").'</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table></body><html>';

return $msg;

}
function getmemberpcontact($conn,$id){
	$sqlQry=mysqli_query($conn,"select `pcontact` from `members` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getmemberaboutsectionnew($conn,$id){
	$sqlQry=mysqli_query($conn,"select `description` from `members` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}


function getmemberemailaddressId($conn,$id){
	$sqlQry=mysqli_query($conn,"select `email` from `members` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}


function getMemberNameById($conn,$id){


	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `members` where `id` ='$id' "));



	
 


	$name=getTabledataById($conn,"name","titles",$fetchRes[1])." ".$fetchRes[2]." ".$fetchRes[3]." ".$fetchRes[4];



	



	return $name;	



	



}
function getProfileUserNameByIdAndType($conn,$id,$type){



	if($type==1){



		$username=getUserNameById($conn,$id);



	}



	




	if($type==2){



		$username=getMemberNameById($conn,$id);



	}



	return $username;



}

function getUserNameById($conn,$id){



	$sqlQry=mysqli_query($conn,"select `fname`,`lname` from `user` where `id`='$id'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry[0]." ".$fetchQry[1] ;



}

function geShortUserNameById($conn,$id){



	$sqlQry=mysqli_query($conn,"select `fname` from `user` where `id`='$id'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry[0] ;



}


function getUserDetailById($conn,$id){



	$sqlQry=mysqli_query($conn,"select * from `user` where `id`='$id'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry;



}
function updateCartQty($conn,$pid,$magtype,$qty){
	
$count=-1;
   foreach($_SESSION['cart_array']["bag"] as $arr){
	   $count++;
	if(  ($arr[0]==$pid ) && ($arr[1]==$magtype ) ){
		   $oldQty=$_SESSION['cart_array']["bag"][$count][2];
		
		  $_SESSION['cart_array']["bag"][$count][2]=$oldQty+$qty;
		 
	}
	   
   }
   return true;	
	
}

function getcountrynamefromid($conn,$id)
{
	
	
	$fetchRes=mysqli_query($conn,"select `name` from `country` where `id` ='$id'");
$result=mysqli_fetch_row($fetchRes);
return $result[0];

	
	
}

function getproductstockfrompids($conn,$pid)
{ 
$fetchRes=mysqli_query($conn,"select `stock` from `productstock` where `pid`='$pid'");
$result=mysqli_fetch_row($fetchRes);
return $result[0];



}

function checkproductstockofmagazine($conn)
{
	//echo "select * from `orders` where `u_id`='$id' and `contype`='$type'";
	$sqlQry=mysqli_query($conn,"select * from `productstock` where `stock`!='' and `stock`!='0'");
//	echo "select * from `subcategories` where `cat_id`='$id' ";
	
	$numRows=mysqli_num_rows($sqlQry);
	
	if($numRows>0){
	//echo $numRows;
		while($fetch=mysqli_fetch_array($sqlQry)){



			$magazinesid[]=$fetch['pid'];



		}


	}
	else{$magazinesid="0";
	}

	return $magazinesid;
	
	
	
	}

	
	

function changeCartQty($conn,$pid,$magtype,$qty){
$count=-1;
   foreach($_SESSION['cart_array']["bag"] as $arr){
	   $count++;
	 
	
	if(  ($arr[0]==$pid ) && ($arr[1]==$magtype ) ){
		 
		
		  $_SESSION['cart_array']["bag"][$count][2]=$qty;
		  
		 
	}
	   
   }
   return true;	
	
}
/*function updateCartQty($pid,$magtype,$qty){
$count=-1;

 	
    
   foreach($_SESSION['cart_array']["bag"] as $arr){
	 $count++;
	if(  ($arr[0]==$pid )&& ($arr[1]==$magtype) ){
		
		   $oldQty=$_SESSION['cart_array']["bag"][$count][1];
		
		  $_SESSION['cart_array']["bag"][$count][1]=$oldQty+$qty;
		 
		 
	}
	   
   } 
   return true;	 
}*/
function getLaImageByPid($conn,$pid){
	
	 $sqlQry=mysqli_query($conn,"select `imagepath` from `singleissueimage` where `m_id`='$pid' and `status`='1' order by `position` asc");
	 
	$numrows=mysqli_num_rows($sqlQry);
	if($numrows>0){
		$fetchQry = mysqli_fetch_row($sqlQry);
		$image = $fetchQry[0];
	}else{
		$image=0;
	}
return $image;	
}


function getsinglemagazinename($conn,$id){
 
	$sqlQry=mysqli_query($conn,"select `title` from `singleissue` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getuserdetailsfromid($conn,$id)
{
	
	$sqlQry=mysqli_query($conn,"select * from `user` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	return $fetchQry;
	
	
}
function checkCartmagzibeexist($conn,$pid,$magtype){
	$count=-1;
	$status=0;
	foreach($_SESSION['cart_array']["bag"] as $arr){
	$count++;
	if(  ($arr[0]==$pid )&& ($arr[1]==$magtype)){
		$status=1;
	}
	
	}
	
	return $status;
	
}

function checkCartmagzinecatexist($conn,$magyear,$magtype,$catid,$qty){
	$count=-1;
	$status=0;
	foreach($_SESSION['cart_array']["bag"] as $arr){
	$count++;
	if(  (($arr[4]==$magyear )&& ($arr[1]==$magtype))&& ($arr[3]==$catid) && ($arr[3]==$qty)){
		$status=1;
	}
	
	}
	
	return $status;
	
}
function getmagazinedetails($conn,$slug){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `singleissue` where `slug` ='$slug'"));

	return $fetchRes;

}




function singleissuedetails($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `singleissue` where `id` ='$id'"));

	return $fetchRes;

}
function getProductPriceById($conn,$id,$magtype){
	if($magtype=='eprice'){$val='eprice';}
	else if($magtype=='pprice'){$val='pprice';}
	$sqlQry=mysqli_query($conn,"select `$val` from `singleissue` where `id`='$id'");
	$fetchQry=mysqli_fetch_row($sqlQry);
	$price=$fetchQry[0];		
	return $price;
}

function getmonth($conn,$month){

	if($month=='01'){$monthnew='Jan';}
	else if($month=='02'){$monthnew='Feb';}
	else if($month=='03'){$monthnew='Mar';}
	else if($month=='04'){$monthnew='Apr';}
	else if($month=='05'){$monthnew='May';}
	else if($month=='06'){$monthnew='June';}	
	else if($month=='07'){$monthnew='July';}
	else if($month=='08'){$monthnew='Aug';}
	else if($month=='09'){$monthnew='Sept';}
	else if($month=='10'){$monthnew='Oct';}
	else if($month=='11'){$monthnew='Nov';}
	else if($month=='12'){$monthnew='Dec';}
return $monthnew;
	
}
function getmagazinecategorynamenew($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `name` from `mcategory` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];	

}
function getmagazinedetailslatestmothandyear($conn){
$year=date("Y");
$month=date("m");
//echo "select * from `singleissue` where `month` ='$month' and `year`='$year'";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `singleissue` where `month` ='$month' and `year`='$year'"));

	return $fetchRes[0];

}

function getalldetailsusingcatid($conn,$id)
{
$sqlQry=mysqli_query($conn,"select * from `mcategory` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry;	

}
function getnameofsingleissuemname($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `title` from `singleissue` where `id` ='$id' ");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];	

}
function getlatestmagzinealttext($conn,$id){

$sqlQry=mysqli_query($conn,"select `alttext` from `singleissueimage` where `m_id`='$id' and `status`='1' order by `id` Desc limit 0,1");
$numrows=mysqli_num_rows($sqlQry);
if($numrows>0){
$fetchQry = mysqli_fetch_row($sqlQry);
$alttext = $fetchQry[0];
}
return $alttext;	
}
function getlatestmagzineimage($conn,$id){
$sqlQry=mysqli_query($conn,"select `imagepath` from `singleissueimage` where `m_id`='$id' and `status`='1' order by `id` Desc limit 0,1");
$numrows=mysqli_num_rows($sqlQry);
if($numrows>0){
$fetchQry = mysqli_fetch_row($sqlQry);
$image = $fetchQry[0];
}else{
$image="noimage.jpg";
}
return $image;	
}

function getlatestmagzinesingleissue($conn,$id){

$sqlQry=mysqli_query($conn,"select `imagepath` from `singleissueimage` where `status`='1' order by `id` Desc limit 0,1");
$numrows=mysqli_num_rows($sqlQry);
if($numrows>0){
$fetchQry = mysqli_fetch_row($sqlQry);
$image = $fetchQry[0];
}else{
$image="nomag.jpg";
}
return $image;	
}


function thumbNailmagazine($conn,$oldname,$width,$height){
	
if($oldname==''){
$oldname='nomag.jpg';	
}
if(!file_exists($baseurl."photos/".$oldname)){
$oldname='nomag.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."thumb/". $imgName;  
if(!file_exists($newname)){
$imgpath=$width."_".$height."_".$oldname;
$size = getImageSize($baseurl."photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."photos/".$oldname);
break;
}
$thumb = thumbnail_boxs($conn,$resimage, $width, $height);
imagedestroy($resimage);
if(is_null($thumb)) {
header('HTTP/1.1 500 Internal Server Error');
exit();
}
imagejpeg($thumb,$newname);
return  $imgName;	  
}else{
return  $imgName;	  
}
}


function createThumbNailmagzine($oldname,$width,$height,$baseurl){

if($oldname==''){
$oldname='nomag.jpg';	
}
if(!file_exists($baseurl."photos/".$oldname)){
$oldname='nomag.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."thumb/". $imgName;
if(!file_exists($newname)){
$thumbw = $width;
$thumbh = $height;
$nh = $thumbh;
$nw = $thumbw;
$size = getImageSize($baseurl."photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
$ratio = $h / $w;
$nratio = $nh / $nw; 
if($ratio > $nratio)
{
$x = intval($w * $nh / $h);
if ($x < $nw)
{
$nh = intval($h * $nw / $w);
} 
else
{
$nw = $x;
}
}
else
{
$x = intval($h * $nw / $w);
if ($x < $nh)
{
$nw = intval($w * $nh / $h);
} 
else
{
$nh = $x;
}
}  
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."photos/".$oldname);
break;
}
$newimage = imagecreatetruecolor($nw, $nh);  
imageCopyResampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);
 $viewimage = imagecreatetruecolor($thumbw, $thumbh);
imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);
imagejpeg($viewimage, $newname, 85);
return $imgName;
}else{
return $imgName;   

	}

}


function getmagazinepricefromsession($conn,$year,$type,$cat)
{ $addv="yr";
if($type=="E-Magazine")
{
	$addt="emag";
	
}
else if(($type=="Printed") || ($type=="print"))
{
	
		$addt="print";

}
else if($type=="Combo")
{
	
		$addt="combo";

}
	$val3=$addv.$year.$addt;
	$execQry=mysqli_query($conn,"select `$val3` from `magazineplanamount` where `cat_id` ='$cat' and `status`='1'");
$fetchQry=mysqli_fetch_row($execQry);
$price=$fetchQry[0];
	
return $price;	
}
function populateData1234($conn,$bag,$userDetail,$userid,$total,$dpercent,$damt,$finalprice12,$contype){
	$pdate=date("Y-m-d h:i:s");
							  $fname=$userDetail['fname']; 
				$lname=$userDetail['lname']; 
				$phone=$userDetail['phone']; 
				$add=$userDetail['address']; 
				$email=$userDetail['email']; 
			//	$oadd=$userDetail['billing_address_op']; 
				$town=$userDetail['statecity']; 
				
								$type='1'; 

				$code=$_POST['zip']; 

	$cartDetail=mysqli_real_escape_string($conn,$bag);
	
	if($type==1)
	{
	$insQry1==mysqli_query($conn,"INSERT INTO `orders`(`id`, `u_id`, `name`, `address`, `landmark`, `pincode`, `state`, `mobile`, `purchasedate`, `status`, `email`, `type`, `paymentstatus`, `discount`,`grand`,`contype`,`beforediscount`,`dscamt`) VALUES (NULL,'$userid','$fname','$add','$oadd','$code','$town','$phone','$pdate','1','$email','$type','1','$dpercent','$finalprice12','$contype','$total','$damt')");
	}
	
	else
	{
		$insQry1==mysqli_query($conn,"INSERT INTO `orders`(`id`, `u_id`, `name`, `address`, `landmark`, `pincode`, `state`, `mobile`, `purchasedate`, `status`, `email`, `type`, `paymentstatus`, `discount`,`grand`,`contype`,`beforediscount`,`dscamt`) VALUES (NULL,'$userid','$fname','$add','$oadd','$code','$town','$phone','$pdate','1','$email','$type','0','$dpercent','$finalprice12','$contype','$total','damt')");
		
		
	}
			$ins_id=mysqli_insert_id($conn);

	if($ins_id!=0){
		
		//$shopQry=mysqli_query("insert into `shoppingcart` set `a_id`='$ins_id',`item`='$cartDetail',`type`='$type'" );  
		if(!count($_SESSION['cart_array']["bag"])<1){
        
         $prodArray=$_SESSION['cart_array']["bag"];
		// print_r($prodArray);
         foreach($prodArray as $product){
          $count++;
        
        	 $pid=$product[0];
        	 $magtype=$product[1];
			 $qty=$product[2];
			 $catid=$product[3];
			 $magyear=$product[4];

			 
			 if($magtype=="E-Magazine")
			 {
				 
				$magtype1="E-Magazine"; 
				 
			 }
			 
			 else
			  if($magtype=="Printed")
			  {
				  
								$magtype1="Printed"; 
  
				  
			  }
			if($catid=='0'){
			$prodName=getsinglemagazinename($conn,$pid);
        
            $prodPrice=getProductPriceById($conn,$pid,$magtype);
        
            $image=getLaImageByPid($conn,$pid);
        
            $price=$prodPrice*$qty;
        
            $newprodPrice=($prodPrice*$qty);
        
            $subTotal=$subTotal+$price;
			
			}
			if($catid!='0'){
				
				$prodName=getmagazinecategorynamenew($conn,$catid);
				$prodPrice=getmagazinepricefromsession($conn,$magyear,$magtype,$catid);
				$price=$prodPrice;
				$image='2.jpg';
        		$subTotal=$prodPrice;
				
				}
        	
			 
       $exq= mysqli_query ($conn,"INSERT INTO `newshoppingcart`( `pid`, `catid`, `magtype`, `qty`, `magyear`, `price`, `type`,`aid`) VALUES ('$pid','$catid','$magtype1','$qty','$magyear','$subTotal',$type,$ins_id)");
		 
		 }
		}
		if($shopQry){
			return $ins_id;
		}else{
			return false;
		}
	}else{
		return false;
	}
	
	
}


function getallorderidfromuserid($conn,$id,$type)
{
	//echo "select * from `orders` where `u_id`='$id' and `contype`='$type'";
	$sqlQry=mysqli_query($conn,"select * from `orders` where `u_id`='$id' and `contype`='$type' and `status`='1'");
//	echo "select * from `subcategories` where `cat_id`='$id' ";
	
	$numRows=mysqli_num_rows($sqlQry);
	
	if($numRows>0){
	//echo $numRows;
		while($fetch=mysqli_fetch_array($sqlQry)){



			$contentId[]=$fetch['id'];



		}



	}else{



			$contentId[]=0;



	}



	return $contentId;



	
	
}


function getallpidsfromorderidforsingle($conn,$id)
{
	//echo "select * from `orders` where `u_id`='$id' and `contype`='$type'";
	$sqlQry=mysqli_query($conn,"select * from `orders` where `aid`='$id' ");
//	echo "select * from `subcategories` where `cat_id`='$id' ";
	
	$numRows=mysqli_num_rows($sqlQry);
	
	if($numRows>0){
	//echo $numRows;
		while($fetch=mysqli_fetch_array($sqlQry)){



			$contentId[]=$fetch['pid'];



		}



	}else{



			$contentId[]=0;



	}



	return $contentId;



	
	
}
function getallcategorydetailsfromid($conn,$id){



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `mcategory` where `id`='$id'"));



	return $resultSet;



}



function getlatestmagazineslug($conn){
	 $pdate=date("Y-m-d");
	 $datearry=explode("-",$pdate);
	$year=$datearry[0];
	$month=$datearry[1];
	 
//echo "select `slug` from `singleissue` where `status`='1' order by `id` desc";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `singleissue` where `status`='1' and `cat_id`='2' and `month`='$month' and `year`='$year' order by `id` desc"));

	return $fetchRes[0];
}
function getcategoryidfromslug1($conn,$slug)
{
	
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `cat_id` from `singleissue` where `status`='1' order by `id` desc"));

	return $fetchRes[0];
	
	
}

 function getmagazineplanamountdetails($conn,$catid){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `magazineplanamount` where `cat_id` ='$catid' and `status`='1'"));

	return $fetchRes;

}
function getallproductsyear($conn)
{
	
$query=mysqli_query($conn,"select * from `singleissue` where `status`='1'");			
										
							while($fetchres=mysqli_fetch_array($query))	
							{	
							
							$yearids[]=$fetchres['year'];
							
							}
							
							$final=array_unique($yearids);
								
						return 	$final;				
}
function getcreditId($conn,$id){

	$val=1000+$id;

	return "LPCREDIT".$val;

}

function getmembercreditDetailById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `creditpay` where `id` ='$id'  "));

	return $fetchRes;

}


function getidfromarticleslug($conn,$articleslug)
{

	$query=mysqli_query($conn,"select `id` from `wellness` where `slug`='$articleslug' and `view`='1' and `status`='1'");			

	$fetchres=mysqli_fetch_row($query);
	
	return $fetchres[0];
	
	
}


function getallarticledetails($conn,$articleid)
{
	$query=mysqli_query($conn,"select * from `wellness` where `id`='$articleid'");			

	$fetchres=mysqli_fetch_row($query);
	
	return $fetchres;
	
	
	
}

function getalluserinterestids($conn,$uid,$con)
{
	//echo "select * from `userinterest` where `userid`='$uid' and `contype`='$con'";
	$query=mysqli_query($conn,"select * from `userinterest` where `userid`='$uid' and `contype`='$con'");			
$numrows=mysqli_num_rows($query);
if($numrows>0)
{
	while($fetchres=mysqli_fetch_array($query))	
							{	
							
							$interestids[]=$fetchres['interest'];
							
							}
}
else
{
	
	
}
								
						return 	$interestids;				
	
	
}

function getnamefromtagid($conn,$id)
{
	
	$query=mysqli_query($conn,"select `name` from `tags` where `id`='$id' and `status`='1' and `view`='1'");
		$fetchres=mysqli_fetch_row($query);
	
	return $fetchres[0];
			
	
	
	
}

function getalltagdetailsfromtagid($conn,$id)
{
	
	$query=mysqli_query($conn,"select * from `tags` where `id`='$id' and `status`='1' and `view`='1'");
		$fetchres=mysqli_fetch_row($query);
	
	return $fetchres;
			
	
	
	
}

function gettagidfromname($conn,$id)
{
	
	$query=mysqli_query($conn,"select `id` from `tags` where `name`='$id' and `status`='1' and `view`='1'");
		$fetchres=mysqli_fetch_row($query);
	
	return $fetchres[0];
			
	
	
	
}

function getviewscountfromuserid($conn,$id,$aid)
{
	
	
	//$query=mysqli_query($conn,"select * from `pageviews` where `userid`='$id' and `articleid`='$aid'");
	$query=mysqli_query($conn,"select * from `pageviews` where `articleid`='$aid'");
		$fetchres=mysqli_num_rows($query);
	if($fetchres>=1)
	{
		
				$results=mysqli_fetch_row($query);
				$value=$results[0];

		
	}
	
	else
	{
						$value=0;

		
		
	}
	return $value;
			

	
	
}

function getexistingviews($conn,$id,$aid)
{
	
	$query=mysqli_query($conn,"select `views` from `pageviews` where `articleid`='$aid'");
		$fetchres=mysqli_num_rows($query);
					$results=mysqli_fetch_row($query);


		return $results[0];

}


function totalviewcountfromaid($conn,$aid)
{
	$count=0;
		$query=mysqli_query($conn,"select * from `pageviews` where `articleid`='$aid' ");

	
	while($fetch=mysqli_fetch_array($query)){



			$count+=$fetch['views'];



		}
	
	return $count;
}

function checkusernterestexist($conn,$uid,$contype)
{
	
	//echo "select * from `userinterest` where `userid` ='$uid' and `contype`='$contype'";
	$execQry=mysqli_query($conn,"select * from `userinterest` where `userid` ='$uid' and `contype`='$contype'");
 $numrows=mysqli_num_rows($execQry);
if($numrows>=1)
{
return '0';


}

else
{
	
	return '1';

	
	
}

	
	
	
}


function getarticleidsfromcategoryid($conn,$id)
{
	//echo "select * from `wellnesstag` where `tag_id` ='$id'";
	
		$execQry=mysqli_query($conn,"select * from `wellnesstag` where `tag_id` ='$id' order by `id` desc");
	 	$num=mysqli_num_rows($execQry);
		
		if($num>=1)
		{
		while($fetch=mysqli_fetch_array($execQry)){


$checkst=checkstatusandviewofarticle($conn,$fetch['q_id']);
if($checkst==1)
{
			$contentId[]=$fetch['q_id'];
}


		}

		}
		
		
		else
		{
						$contentId='0';

			
			
		}
		
		
		return $contentId;
		
}



function getslugfromarticetitle($conn,$title)
{

	$query=mysqli_query($conn,"select `slug` from `wellness` where `title`='$title' and `status`='1' and `view`='1'");			

	$fetchres=mysqli_fetch_row($query);
	
	return $fetchres[0];
	
	
}

function getcommentcountfromaid($conn,$articleid)
{
	//echo "select * from `articlecomment` where `articleid` ='$articleid' and `status`='1'and `view`='1'";
	$fetchRes=mysqli_query($conn,"select * from `articlecomment` where `articleid` ='$articleid' and `status`='1'and `view`='1'");
 $numrows=mysqli_num_rows($fetchRes);
	return $numrows;

}

function getlatestbannermultimag($conn){
$sqlQry=mysqli_query($conn,"select `imagepath` from `multimagbanner` where `status`='1' order by `id` Asc");
$numrows=mysqli_num_rows($sqlQry);
if($numrows>0){
$fetchQry = mysqli_fetch_row($sqlQry);
$image = $fetchQry[0];
}else{
$image=0;
}
return $image;    
}

function getmagzinepricewithval($conn,$id,$magtype,$dapplicable1){
    
    if ($dapplicable1=='1'){
    
    if($magtype=='eprice'){
        $val='demag';
        }
    else if($magtype=='pprice')
    {$val='dprinted';}
        }
    else if($dapplicable1=='2'){
    
        if($magtype=='eprice')
        {$val='eprice';}
    else if($magtype=='pprice')
    {$val='pprice';}
    
        }
        
    $sqlQry=mysqli_query($conn,"select `$val` from `singleissue` where `id`='$id'");
    $fetchQry=mysqli_fetch_row($sqlQry);
    $price=$fetchQry[0];        
    return $price;
}

function populateData1($conn,$bag,$userDetail,$userid,$total,$dpercent,$damt,$finalprice12,$contype,$city,$ordernotes,$state,$landmark){
    $pdate=date("Y-m-d");
    $ptime=date("h:i:s");
                $fname=$userDetail['fname']; 
                $lname=$userDetail['lname']; 
                $phone=$userDetail['phone']; 
                $add=$userDetail['address']; 
                $email=$userDetail['email']; 
            //    $oadd=$userDetail['billing_address_op']; 
               // $town=$userDetail['statecity']; 
                
                                $type='1';  

                $code=$_POST['zip']; 

    $cartDetail=mysqli_real_escape_string($conn,$bag);
    
    
// echo "INSERT INTO `orders`(`id`, `u_id`, `name`, `address`, `landmark`, `pincode`, `state`, `mobile`, `purchasedate`, `status`, `email`, `type`, `paymentstatus`, `discount`,`grand`,`contype`,`beforediscount`,`dscamt`,`notes`) VALUES (NULL,'$userid','$fname','$add','$landmark','$code','$state','$phone','$pdate','0','$email','$type','0','$dpercent','$finalprice12','$contype','$total','damt','$ordernotes')";
    
        $insQry1==mysqli_query($conn,"INSERT INTO `orders`(`id`, `u_id`, `name`, `address`, `landmark`, `pincode`, `state`, `mobile`, `purchasedate`, `status`, `email`, `type`, `paymentstatus`, `discount`,`grand`,`contype`,`beforediscount`,`dscamt`,`notes`,`city`) VALUES (NULL,'$userid','$fname','$add','$landmark','$code','$state','$phone','$pdate','0','$email','$type','0','$dpercent','$finalprice12','$contype','$total','$damt','$ordernotes','$city')");
        
        
    
            $ins_id=mysqli_insert_id($conn);

    if($ins_id!=0){
        
       // print_r($_SESSION['cart_array']["bag"]); die;
        //$shopQry=mysqli_query("insert into `shoppingcart` set `a_id`='$ins_id',`item`='$cartDetail',`type`='$type'" );  
        if(!count($_SESSION['cart_array']["bag"])<1){
        
         $prodArray=$_SESSION['cart_array']["bag"];
         foreach($prodArray as $product){
          $count++;
            

             $pid=$product[0];
             
             $magtype=$product[1];
             $qty=$product[2];
             $catid=$product[3];
             $magyear=$product[4];
             
            // if($magtype=="eprice")            
			  if(($magtype=="eprice")||($magtype=="E-Magazine"))

             {
                 
                $magtype1="E-Magazine"; 
                 
             }
             
             else
              if(($magtype=="pprice")|| ($magtype=="print"))
              {
                  
            $magtype1="Printed"; 
  
            }
            if($catid=='0'){
            $prodName=getsinglemagazinename($conn,$pid);
             $magazinearr1=singleissuedetails($conn,$pid);
            $discountapplicable1=$magazinearr1[19];
            $month1=getmonth($conn,$magazinearr1[7]);    
            $startdate1=$magazinearr1[20];
            $enddate1=$magazinearr1[21];
$pdate1=date("Y-m-d");
if($discountapplicable1=='1'){
if($enddate1>=$pdate1)
{$dapplicable1='1';}
else if($enddate1<$pdate1)
{
    $dapplicable1='2';}
}else{
$dapplicable1='2';}
    
    


            $prodPrice=getmagzinepricewithval($conn,$pid,$magtype,$dapplicable1);
       
            $image=getLaImageByPid($conn,$pid);
        
            $price=$prodPrice*$qty;
        
            $newprodPrice=($prodPrice*$qty);
        
            $subTotal=$subTotal+$price;
            
            }
            if($catid!='0'){
                            

                $prodName=getmagazinecategorynamenew($conn,$catid);
                $prodPrice=getmagazinepricefromsession($conn,$magyear,$magtype,$catid);
                $price=$prodPrice;
                $image='2.jpg';
                $subTotal=$prodPrice;
				
				 if($magtype=="E-Magazine")
             {
                 
                $magtype1="E-Magazine"; 
                 
             }
             
             else
              if($magtype=="Printed")
              {
                  
            $magtype1="Printed"; 
  
            }
                
                }
            
             $exq= mysqli_query ($conn,"INSERT INTO `newshoppingcart`( `pid`, `catid`, `magtype`, `qty`, `magyear`, `price`, `type`,`aid`) VALUES ('$pid','$catid','$magtype1','$qty','$magyear','$price',$type,$ins_id)");
         
         } 
        }
        if($exq){
            return $ins_id;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
    
}

function getuserlikesfromaid($conn,$articleid)
{
	
	$fetchRes=mysqli_query($conn,"select * from `userlikes` where `articleid` ='$articleid'");
$numrows=mysqli_num_rows($fetchRes);
	return $numrows;

}


function discountapplicable($conn,$pid)
{
	$pdate=date("Y-m-d");
	$fetchRes=mysqli_query($conn,"select `startdate`,`enddate` from `singleissue` where `id`='$pid'");
	$result=mysqli_fetch_row($fetchRes);

$sdate=$result[0];
$edate=$result[1];
	$fetchRes=mysqli_query($conn,"select `demag` from `singleissue` where '$pdate' between '$sdate' and '$edate' and `id`='$pid'");
$result=mysqli_fetch_row($fetchRes);
	return $result[0];

}


function createThumbNail($conn,$oldname,$width,$height,$baseurl){
	//echo $oldname; die;

if($oldname==''){



  $oldname='nophoto.jpg';



}


 if(!file_exists($baseurl."/photos/".$oldname)){



   $oldname='nophoto.jpg';



  }

  

   

  



	$imgName=$width."_".$height."_".$oldname;



  







	$newname = $baseurl."/thumb/". $imgName;

	

	

	   if(!file_exists($newname)){

	

	$thumbw = $width;



	$thumbh = $height;



	$nh = $thumbh;



	$nw = $thumbw;



	$size = getImageSize($baseurl."/photos/".$oldname);



	$w = $size[0];



	$h = $size[1];



	$img_type=$size[2];



	$ratio = $h / $w;



	$nratio = $nh / $nw; 







  if($ratio > $nratio)



  {



    $x = intval($w * $nh / $h);



    if ($x < $nw)



    {



      $nh = intval($h * $nw / $w);



    } 



    else



    {



      $nw = $x;



    }



  }



  else



  {



    $x = intval($h * $nw / $w);



    if ($x < $nh)



    {



      $nw = intval($w * $nh / $h);



    } 



    else



    {



      $nh = $x;



    }



  }  



	



		



		//die($img_type);



	switch($img_type) {



          case '1':



          $resimage = imagecreatefromgif($baseurl."/photos/".$oldname);



          break;



          case '2':



          $resimage = imagecreatefromjpeg($baseurl."/photos/".$oldname);



          break;



          case '3':



          $resimage = imagecreatefrompng($baseurl."/photos/".$oldname);



          break;



      }







  //$resimage = imagecreatefromjpeg($oldname); 



  $newimage = imagecreatetruecolor($nw, $nh);  



  // use alternate function if not installed



  imageCopyResampled($conn,$newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);




  



  // Making the final cropped thumbnail



  



  $viewimage = imagecreatetruecolor($thumbw, $thumbh);



  imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);



  



  // saving



  imagejpeg($viewimage, $newname, 85);







	return $imgName;

	   }else{

	return $imgName;   

	}

}
function createthumbNailforarticles($conn,$oldname,$width,$height){
if($oldname==''){
$oldname='nomag.jpg';	
}
if(!file_exists($baseurl."photos/".$oldname)){
$oldname='nomag.jpg';
}
$imgName=$width."_".$height."_".$oldname;
$newname = $baseurl."thumb/". $imgName;  
if(!file_exists($newname)){
$imgpath=$width."_".$height."_".$oldname;
$size = getImageSize($baseurl."photos/".$oldname);
$w = $size[0];
$h = $size[1];
$img_type=$size[2];
switch($img_type) {
case '1':
$resimage = imagecreatefromgif($baseurl."photos/".$oldname);
break;
case '2':
$resimage = imagecreatefromjpeg($baseurl."photos/".$oldname);
break;
case '3':
$resimage = imagecreatefrompng($baseurl."photos/".$oldname);
break;
}
$thumb = thumbnail_boxs($conn,$resimage, $width, $height);
imagedestroy($resimage);
if(is_null($thumb)) {
header('HTTP/1.1 500 Internal Server Error');
exit();
}
imagejpeg($conn,$thumb,$newname);
return  $imgName;	  
}else{
return  $imgName;	  
}
}
function getallaidswithoutcategory($conn)
{
	
	$execQry=mysqli_query($conn,"select * from `wellness` where `status` ='1' and `view`='1'");
		$num=mysqli_num_rows($execQry);
		
		if($num>1)
		{
		while($fetch=mysqli_fetch_array($execQry)){



			$contentId[]=$fetch['id'];



		}

		}
		
		
		else
		{
						$contentId='0';

			
			
		}
		
		
		return $contentId;
		
	
	
	
}

function getallextrachargesbycid($conn,$cid) 
{
	
	$fetchRes=mysqli_query($conn,"select * from `country` where `id` ='$cid'");
$result=mysqli_fetch_row($fetchRes);
return $result;
}



function getCitiesNameById($conn,$id){



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `cities` where `city_id`='$id'"));



	return $resultSet[1];



}
function strreplace($conn,$string){



$str=preg_replace('/[^0-9a-zA-Z]/',"-",$string);



$str=str_replace("--","-",$str);



return $str;



}
function getConsultantSessionTypes($conn,$cid){



	$sessiontypes=array();



	$execQry=mysqli_query($conn,"select * from `membersessions` where `status` = '1' and `mem_id`='$cid' order by `id` desc");



	$numRows=mysqli_num_rows($execQry);



	if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){

 
              if(checkSessionisActive($conn,$fetch['sess_id'])){  
			$sessiontypes[]=$fetch['sess_id'];
			  }



		}



	}else{



	}



	//$sessIds=getConsultantSessionTypeNames($sessiontypes);



	return $sessiontypes;



}


function getSplzStatusById($conn,$id){

$selQry=mysqli_fetch_row(mysqli_query($conn,"select `status`,`view`  from `specials` where  `id`='$id'  "));

$status=$selQry[0];
$view=$selQry[1];
if( ($status==0) || ($view==0)){
return false;	
}else{
return true;	
}

}


function getConsultantSpecialization($conn,$cid){



	$splypes=array();

//echo "select * from `memberspecialization` where `status` = '1' and `mem_id`='$cid' order by `id` desc";

	$execQry=mysqli_query($conn,"select * from `memberspecialization` where `status` = '1' and `mem_id`='$cid' order by `id` desc");


	 $numRows=mysqli_num_rows($execQry);



	if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){


if(getSplzStatusById($conn,$fetch['spl_id'])){
			$splypes[]=$fetch['spl_id'];
}
			
			



		}



	}else{
		
		
		



	}



	//$sessIds=getConsultantSessionTypeNames($sessiontypes);



	return $splypes;



}

function revertEventDate($conn,$date){



    $expDob=explode("-",$date);



	$expMonth=$expDob[1];	



	$expDate=$expDob[2];



	$expYear=$expDob[0];



	$makedate=$expDate."-".$expMonth."-".$expYear;



	return 	$makedate;



	



}
function revertEventDatenew($conn,$date){



    $expDob=explode("-",$date);



	$expMonth=$expDob[1];	



	$expDate=$expDob[2];



	$expYear=$expDob[0];



	$makedate=$expMonth."/".$expDate."/".$expYear;



	return 	$makedate;



	



}


function shortDays($conn){

$headings = array('Mo','Tu','We','Th','Fr','Sa','Su');	

return $headings;

}

function randomPassword($conn) {



    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";



    $pass = array(); //remember to declare $pass as an array



    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache



    for ($i = 0; $i < 8; $i++) {



        $n = rand(0, $alphaLength);



        $pass[] = $alphabet[$n];



    }



    return implode($pass); //turn the array into a string



}


function randomOtpnew($conn) {



    $alphabet = "0123456789";



    $pass = array(); //remember to declare $pass as an array



    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache



    for ($i = 0; $i < 6; $i++) {



        $n = rand(0, $alphaLength);



        $pass[] = $alphabet[$n];



    }



    return implode($pass); //turn the array into a string


}

function randomOtp($conn) {



   /* $alphabet = "0123456789";



    $pass = array(); //remember to declare $pass as an array



    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache



    for ($i = 0; $i < 6; $i++) {



        $n = rand(0, $alphaLength);



        $pass[] = $alphabet[$n];



    }*/

$pdate=date("Y-m-d");
$explodedstring=explode("-",$pdate);
$pass=$explodedstring[2].$explodedstring[0];

   // return implode($pass); //turn the array into a string


return $pass;
}





function sendMsg($mobile,$msg){



$message=rawurlencode($msg);



$url="https://api-alerts.solutionsinfini.com/v3/?method=sms&api_key=Aedff55c01543d120b1af9b6d8ce5acc1&to=".$mobile."&sender=LIFPOS&message=".$message.""; 




$objURL = curl_init($url);



curl_setopt($objURL, CURLOPT_RETURNTRANSFER, true);



curl_setopt($objURL,CURLOPT_POST,true);



curl_setopt($objURL, CURLOPT_POSTFIELDS,$data);



$retval = trim(curl_exec($objURL));



curl_close($objURL);



}


function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') {
	if(($latitude1==$latitude2) && ($longitude1==$longitude2))
	{
		$distance="0";
		return $distance;
		
		
	}
	else 
	{
     $theta = $longitude1 - $longitude2;
     $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
     $distance = acos($distance);
     $distance = rad2deg($distance);
     $distance = $distance * 60 * 1.1515; switch($unit) {
          case 'Mi': break; case 'Km' : $distance = $distance * 1.609344;
     }
     return (round($distance,2));
	}
}
function gethealerlistingbylatlongcp($conn,$lat,$long){
		$execQry=mysqli_query($conn,"select `id`,`latitude`,`longitude` from `members` where `latitude`!='' and `longitude`!='' and `status`='1' and `view`='1' and `imagepath`!=''");

		 $numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){


 $distance=getDistanceBetweenPointsNew($lat, $long, $fetch['latitude'], $fetch['longitude']);
if($distance<=20)
{
	
			$menuids[]=$fetch['id'];

}

		}



		}else{



			$menuids[]=0;



		}



	return $menuids;



}


function gwtworkshoplistingbylatandlong($conn,$lat,$long){
		$execQry=mysqli_query($conn,"select `id`,`latitude`,`longitude` from `events` where `latitude`!='' and `longitude`!=''  and `status`='1'");

		 $numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){


 $distance=getDistanceBetweenPointsNew($lat, $long, $fetch['latitude'], $fetch['longitude']);
if($distance<=20)
{
			$menuids[]=$fetch['id'];

}

		}



		}else{



			$menuids[]=0;



		}



	return $menuids;



}


function getProfessionIconById($conn,$id){



	$slug=trim($slug);



	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `imagepath` from `books` where `id`='$id'"));



	if( $resultSet[0]==''){



		return 	'noicon.png';	



	}else{



		return 	$resultSet[0];



	}



}



function getProfessionLinkHeadingNameById($conn,$id){


	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `linkheading` from `books` where  `id`='$id'  "));



	return $execQry[0];


}

function getservicefeesfromid($conn,$sid,$hid)
{
	
	//echo "select `cost` from `memberprofession` where  `mem_id`='$hid',`prof_id`='$sid'  ";
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `effectedprice` from `memberprofession` where  `mem_id`='$hid' and `prof_id`='$sid'"));



	return $execQry[0];

	
	
}
function getsessiontypefromserviceandhid($conn,$sid,$hid)
{
	
	//echo "select `cost` from `memberprofession` where  `mem_id`='$hid',`prof_id`='$sid'  ";
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `sessiontype` from `memberprofession` where  `mem_id`='$hid' and `prof_id`='$sid'"));



	return $execQry[0];

	
	
}

function getoriginalcostfromserviceidandhid($conn,$sid,$hid)
{
	
	//echo "select `cost` from `memberprofession` where  `mem_id`='$hid',`prof_id`='$sid'  ";
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `cost` from `memberprofession` where  `mem_id`='$hid' and `prof_id`='$sid'"));



	return $execQry[0];

	
	
}
function checkmemberidexistinmemberprofession($conn,$sid,$hid)
{
	
	
//echo "select * from `memberprofession` where  `mem_id`='$hid'and `prof_id`='$sid'  ";
	$execQry=mysqli_query($conn,"select * from `memberprofession` where  `mem_id`='$hid' and `prof_id`='$sid'");


 $numr=mysqli_num_rows($execQry);
	return $numr;

	
	
}
function getConsultantProfessionHeadingNames($conn,$professionArr){



	$professions=array();



	if (count($professionArr)==0){



		return "No Tools";	



	}else{



		foreach($professionArr as $pid){



			$professions[]=getProfessionLinkHeadingNameById($conn,$pid);



		}



	}



	$impProf=implode(", ",$professions);



    return $impProf; 	



}


function getConsultantMainProfessionById($conn,$id){



	$query=mysqli_query($conn,"select count(*) from `memberprofession` where `mem_id`='$id' ");



	$resultSet=mysqli_fetch_row($query);



	if($resultSet[0]==0){



		$profession=0;	



	}else{



	$querymain=mysqli_query($conn,"select count(*) from `memberprofession` where `mem_id`='$id' and `main`='1' ");



	$resultSetmain=mysqli_fetch_row($querymain);



	if($resultSetmain[0]==0){



		$mainProf=mysqli_fetch_row(mysqli_query($conn,"select `prof_id` from  `memberprofession` where `mem_id`='$id'  order by `id` limit 0,1 "));		



		$profession=$mainProf[0];		



	}else{



	$mainProf=mysqli_fetch_row(mysqli_query($conn,"select `prof_id` from  `memberprofession` where `mem_id`='$id' and `main`='1'  order by `id` limit 0,1 "	));		



		$profession=$mainProf[0];			



	}



	}



	return $profession;



 



}
function getConsultantSpecializationNames($conn,$sessionArr){



	$sessions=array();



	if (count($sessionArr)==0){



		return "No Specialization";	



	}else{



		foreach($sessionArr as $sessid){



			$sess[]=getSpecializationNameById($sessid);



		}



	}



	$impSessions=implode(", ",$sess);



    return $impSessions; 	



}




function getConsultantDetailsById($conn,$id){


	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `members` where  `id`='$id' "));



	return $execQry;



}

function getexistenceintophealer($conn,$memid)
{
	
	$execQry=mysqli_query($conn,"select * from `tophealers` where  `mem_id`='$memid' ");

$num=mysqli_num_rows($execQry);
if($num>0)
{
	$fetch=mysqli_fetch_row($execQry);
	$res=$fetch[0];
	
}
else
{
		$res=0;

	
}
	return $res;
	
	
}

function changeDateFormat12($conn,$date){
$expDob=explode("/",$date);
$expMonth=$expDob[0];    
$expDate=$expDob[1];
$expYear=$expDob[2];
$makedate=$expYear."-".$expMonth."-".$expDate;
return     $makedate;
}

function getalldetailsofmemberprofessionfromservicetype($conn,$proid,$locationhealer)
{
	
	
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `memberprofession` where  `prof_id`='$proid' and `mem_id`='$locationhealer' "));



	return $execQry;
	
}


function getsessionoffervalidityfromid($conn,$pid,$hid)
{$pdate=date("Y-m-d");
	//echo "select `start`,`end` from `memberprofession` where `prof_id`='$pid' and `mem_id`='$hid' ";
	
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `start`,`end` from `memberprofession` where `prof_id`='$pid' and `mem_id`='$hid' "));

 $start=$execQry[0];
 $end=$execQry[1];


if(($pdate>=$start) && ($pdate<=$end))
{
$value=1;	

}

else
{
$value=0;	
	
}


return $value;
}


function getmemberprofessionrecordidfromhealerandservice($conn,$proid,$locationhealer)
{
//echo "select `id` from `memberprofession` where `prof_id`='$proid' and `mem_id`='$locationhealer' ";
$execQry=mysqli_fetch_row(mysqli_query($conn,"select `id` from `memberprofession` where `prof_id`='$proid' and `mem_id`='$locationhealer' "));
return $execQry[0];


}

function getalldetailsofmemberprofessionfromid($conn,$id)
{
	//echo "select * from `memberprofession` where `id`='$id' ";
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `memberprofession` where `id`='$id' "));
return $execQry;

	
	
}

function getProfessionDetailsById($conn,$id){


 
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `books` where  `id`='$id'  "));



	return $execQry;



}

function getarchivedetailformagazaine($conn,$id){


 
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select * from `articles` where  `id`='$id'  "));



	return $execQry;



}


function createslugfrommembername($conn,$pname)
{
return strtolower(strreplace($conn,$pname));

}

function shortlistedmem($conn,$userid,$contype,$aid)
{
	$execQry=mysqli_query($conn,"select * from `shortlist` where `userid` ='$userid' and `contype`='$contype' and `memid`='$aid'");
$numrows=mysqli_num_rows($execQry);
if($numrows==0)
{
return '0';	
	
	
}

else
{
	
return '1';	
	
}

}


function getworkshoplistbylongandlati($conn,$lat,$long){
		$execQry=mysqli_query($conn,"select `id`,`latitude`,`longitude` from `events` where `latitude`!='' and `longitude`!='' ");

		 $numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){


 $distance=getDistanceBetweenPointsNew($lat, $long, $fetch['latitude'], $fetch['longitude']);
if($distance<=25)
{
			$eventids[]=$fetch['id'];

}

		}



		}else{



			$eventids[]=0;



		}



	return $eventids;



}

function getminimumcostofservicefromhid($conn,$hid)
{
	
	$query=mysqli_query($conn,"select * from `memberprofession` where `mem_id`='$hid'");
	$numRows=mysqli_num_rows($query);
	if($numRows>0){



		while($fetch=mysqli_fetch_array($query)){



			$profypes[]=$fetch['effectedprice'];



		}



	}else{


			$profypes=0;


	}
	
	$minimumcost=min($profypes);

return $minimumcost;
	
	
}

function getoriginalminimumcostofservicefromhid($conn,$hid)
{
	
	$query=mysqli_query($conn,"select * from `memberprofession` where `mem_id`='$hid' and `cost`!='0'");
	$numRows=mysqli_num_rows($query);
	if($numRows>0){



		while($fetch=mysqli_fetch_array($query)){

$costt=$fetch['cost'];
if($costt!="")
{

			$profypes[]=$fetch['cost'];

}

		}



	}else{


			$profypes=0;


	}
	
	$minimumcost=min($profypes);

return $minimumcost;
	
	
}

function getwrittenworkshopreviewforshow($conn,$conId)
{
	
	$reviewquery=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$conId' and `status`='1' and `view`='1' and `pagetype`='2' and `type`='1'");
							
							$numre=mysqli_num_rows($reviewquery);
							return $numre;
							
	
	
	
}

function getreviewsofevents($conn,$conId)
{
	
	
	$reviewquery=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$conId' and `status`='1'  and `pagetype`='2' and `star`!='0' and `star`!=''");
							
								$numre=mysqli_num_rows($reviewquery);
							
		
		return $numre;
	
	
}


function getreviewsofeventsnew($conn,$conId)
{
	
	
	$reviewquery=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$conId' and `status`='1'  and `pagetype`='2' and `star`!='0' and `star`!=''");
							
								$numre=mysqli_num_rows($reviewquery);
							
		if($numre)
		{
		while($fetch=mysqli_fetch_array($reviewquery)){



			$profypes[]=$fetch['star'];



		}
		//print_r($profypes);
					
	 $starcount=array_sum($profypes);
	
	$average=$starcount/$numre;
		}
		else
		{
		$average="0";	
			
		}
	return $average;
	
	
	
}

function getcountreviewsbyuser($conn,$conId)
{
	
	$reviewquery=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$conId' and `status`='1' and `view`='1' and `pagetype`='0'");
							
						
$numre=mysqli_num_rows($reviewquery);
							return $numre;
							
	
	
	
}
function getmemeberstartid($conn,$conId)
{
	

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `memberstar` where `id` ='$conId'"));

	return $fetchRes;


	
	
}

function getstarscount($conn,$conId)
{ //echo "select * from `memberstar` where `mem_id`='$conId' and `status`='1' and `view`='1'";
	$reviewquery=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$conId' and `status`='1' and `view`='1'");

							
							$numre=mysqli_num_rows($reviewquery);
							
		if($numre)
		{
		while($fetch=mysqli_fetch_array($reviewquery)){



			$profypes[]=$fetch['star'];



		}
		//print_r($profypes);
					
	 $starcount=array_sum($profypes);
	
	$average=$starcount/$numre;
		}
		else
		{
		$average="0";	
			
		}
	return $average;
	
	
}


function gettotalcoloredstars($conn,$starcount)
{
	
		  $roundedval=round($starcount);
		  
		  if($roundedval==$starcount)
		  {
			  
			  $halfstar=$roundedval-$starcount;
			  
			  
		  }
		  
		  
		  else
		  {if($roundedval>$starcount)
		  {
						  $halfstar=$roundedval-$starcount;
  
			  
			  
		  }
		  
		  
		  else
		  {
			  
			 						  $halfstar=$starcount-$roundedval;
 
			  
		  }
		}	
		
		 $roundedval=$starcount-$halfstar;
	
		if($halfstar>0)
		{
			$type=$roundedval+1;
		}
		
		else
		{
					$type=0;
	
			
		}
	
	for($i=1;$i<=5;$i++)
	{
		
	if($i<=$roundedval)
	{
		
	echo '<i class="fa fa-star" aria-hidden="true"></i>';	
	
		
	}
	
	else if($type==0)

	{
		
						echo '<i class="fa fa-star-o" aria-hidden="true"></i>';	

		
		
	}
	
	
	
		else
		{
		if($type!=0)
		{
			if($type==$i)
			{
					echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';	

				
			}
			
			else
			{
				echo '<i class="fa fa-star-o" aria-hidden="true"></i>';	

				
				
				
			}
			
			
			
		}

			
		}
	
				

				
				
		
	}
		
		
		
		  
		/*	if($halfstar>0)
			{
				
				$showhalf=1;
				
				
			}
		if($halfstar>=0.5)
			{
				
				$addhalf=0;
				
				
			}
			else
			{
				$addhalf=1;
				
			}
			
			
	$forloop=$roundedval+$addhalf;		
	$extra=5-$forloop;
	
	for($i=1;$i<=$roundedval ;$i++)
	{
		
		
		
		
	}*/

}

function getallcentrelocation($conn,$memid)
{
	
	
	$query=mysqli_query($conn,"select * from `clinicaddress` where `mem_id`='$memid'");
	$t=0;
	$num=mysqli_num_rows($query);
	if($num>0)
	{
		
		
		while($fetchq=mysqli_fetch_array($query))
		{
			$t++;
			
			$add=$fetchq['address2'];
						$add1=$fetchq['address1'];

			$plocationarr = explode(',', $add);
$primaryl=$plocationarr[1];
			$lat=$fetchq['latitude']; 
		$long=$fetchq['longitude']; 
 
			$test[]="["."'".$add1." ".$primaryl."'".','.$lat.','.$long.','.$t."]";
			
		}
		
		
	}
	
	return $test;
	
}

function getsinglecentrelocation($conn,$memid)
{
	
	
	$query=mysqli_query($conn,"select * from `members` where `id`='$memid'");
	$t=0;
	$num=mysqli_num_rows($query);
	if($num>0)
	{
		
		
		while($fetchq=mysqli_fetch_array($query))
		{
			$t++;
			
			$add=$fetchq['address2'];
						$add1=$fetchq['address1'];

			$plocationarr = explode(',', $add);
$primaryl=$plocationarr[1];
			$lat=$fetchq['latitude']; 
		$long=$fetchq['longitude']; 
 
			$test[]="["."'".$add1." ".$primaryl."'".','.$lat.','.$long.','.$t."]";
			
		}
		
		
	}
	
	return $test;
	
}
function getotherclinicaddexist($conn,$id)
{
	
	$query=mysqli_query($conn,"select * from `clinicaddress` where `mem_id`='$id'");
	$t=0;
	$num=mysqli_num_rows($query);
	return $num;
	
}
function getalluniquetags($conn)
{
	
	$query=mysqli_query($conn,"select * from `wellnesstag` where `status`='1' ");
		$num=mysqli_num_rows($query);
	if($num>0)
	{
		
		
		while($fetchq=mysqli_fetch_array($query))
		{
			$allt[]=$fetchq['tag_id'];
			
		}
		
		
	}
	
	$newallt=array_unique($allt);
	return $newallt;
			
	
	
	
}

function functogetsinglearticletagfromid($conn,$id)
{
	$query=mysqli_query($conn,"select * from `wellnesstag` where `status`='1' and `q_id`='$id' ");
		$num=mysqli_num_rows($query);
	
		
	$fetchq=mysqli_fetch_array($query);
		if($num>0)
		{
			$allt=$fetchq['tag_id'];
			
		}
		else
		{
			$allt="0";
			
			
		}
		
		
	
	
	
	return $allt;
	
	
	
}
function getmemberidsarraybyprofession($conn,$proid)
{
	$query=mysqli_query($conn,"select `mem_id` from `memberprofession` where `prof_id`='$proid'");

	
	while($res=mysqli_fetch_array($query))
		{
			$selectedhealers[]=$res['mem_id'];
			
		}
		
		return $selectedhealers;
	
}

function CheckUserMobileNumberExists($conn,$mobile){
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select count(*) from `user` where `mobile` ='$mobile' and `view`='1' "));
	$count= $fetchRes[0];
	if($count>0){
	return true;	
	}else{
	return false;	
	}
}
function CheckUserEmailExists($conn,$email){
	//echo "select count(*) from `user` where  `email`='$email'  and `view`='1' ";
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select count(*) from `user` where  `email`='$email'  and `view`='1' "));
	$count= $fetchRes[0];
	if($count>0){
		return true;	
	}else{
		return false;	
	}
}

function CheckUserEmailAndMobileExists($conn,$email,$mobile){
	$fetchRes=mysqli_query($conn,"select * from `user` where  `email`='$email' and `mobile`='$mobile' and `status`='1'  and `view`='1' ");
	$numRows=mysqli_num_rows($fetchRes);
	
	if($numRows>0){
		$result=mysqli_fetch_row($fetchRes);
		$id= $result[0];
		return $id;	
	}else{
		return false;	
	}



}

function regsiterNewBookingUser($conn,$name,$mobile,$email,$password){



	//$pwd=md5($password);



	$pdate=date("Y-m-d");

//echo "INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `created`, `status`, `mobile`, `gender`, `imagepath`) VALUES (NULL, '$name', '$lname', '$email', '$pwd', '$pdate', '1', '$mobile', '', '');";

	$insQry=mysqli_query($conn,"INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `created`, `status`, `mobile`, `gender`, `imagepath`) VALUES (NULL, '$name', '$lname', '$email', '$password', '$pdate', '1', '$mobile', '', '');");



	



	if($insQry){



		$insId=mysqli_insert_id($conn);



		return $insId; 	



	}else{



		return '0';



	}



	



}

function getuseridfromquestionid($conn,$qid)
{
	
	$execQry=mysqli_query($conn,"select `userid` from `seekercase` where `id`= '$qid' ");
	$fetch=mysqli_fetch_row($execQry);

	return $fetch[0];

	
	
}

function getallqidfromhealerid($conn,$id)
{ //echo "select *` from `healercase` where `healer_id`='$id' order by `id` desc";
	$insqry=mysqli_query($conn,"select * from `healercase` where `healer_id`='$id' order by `id` desc");
	
	while($fetch=mysqli_fetch_array($insqry))  
	{
		$qid[]=$fetch['caseid'];
	}
	return $qid;
	
}

function getallonlinehealerswithprofession($conn)
{
	//echo "select * from `membersessions` where `sess_id`='1' ";
	$insqry=mysqli_query($conn,"select * from `membersessions` where `sess_id`='1' ");
	
	while($fetch=mysqli_fetch_array($insqry))  
	{
		$qid[]=$fetch['mem_id'];
	}
	return $qid;
	
	
	
	
	
}

function getallmembersessionsarrayfrom_memid($conn,$id)
{
	//echo "select * from `membersessions` where `sess_id`='1' ";
	$insqry=mysqli_query($conn,"select * from `membersessions` where `mem_id`='$id' ");
	
	while($fetch=mysqli_fetch_array($insqry))  
	{
		$qid[]=$fetch['sess_id'];
	}
	return $qid;
	
	
	
	
	
}

function getmodesnamebyid($conn,$string) 
{
		$intoarr=explode(',',$string);

	foreach($intoarr as $ss)
	{
		
		$squery=mysqli_query($conn,"select * from `sessions` where `id`='$ss'");
		//echo $squery;
		$fetchRes=mysqli_fetch_row($squery);

 $sarr[]= $fetchRes[1];

	}
return 		 $sessionarr=implode(',',$sarr);
	
}


function getSessionTypeNameById($conn,$id){

    if($id==0){

	return "Not Sure";	

	}else{

	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select * from `sessions` where `id`='$id' and `status`='1'"));



	return $resultSet[1];

	}
 
}




function getConsultantSessionTypeNames($conn,$sessionArr){



	//$sessions=array();



	if (count($sessionArr)==0){



		return "No Session type";	



	}else{



		foreach($sessionArr as $sessid){



			$sess[]=getSessionTypeNameById($conn,$sessid);



		}



	}



	$impSessions=implode(", ",$sess);



    return $impSessions; 	



} 


function getprimarylatitudefromhealerid($conn,$id)
{
	
	
	$execQry=mysqli_query($conn,"select `latitude` from `members` where `id`= '$id' ");
	$fetch=mysqli_fetch_row($execQry);

	return $fetch[0];
	
}

function getprimarylongitudefromhealerid($conn,$id){
	
	
	
	$execQry=mysqli_query($conn,"select `longitude` from `members` where `id`= '$id' ");
	$fetch=mysqli_fetch_row($execQry);

	return $fetch[0];
	
	
	 
}
function getSeekerDetailsByUname($conn,$uname){

	$username=mysqli_real_escape_string($conn,$uname);

	$selQry=mysqli_fetch_row(mysqli_query($conn,"select `id`,`email`  from `user` where `status`='1' and `view`='1' and (`email`='$username' or `mobile`='$uname') "));

	return $selQry;

}
   

function checkSeekerUsername($conn,$uname){

	$username=mysqli_real_escape_string($conn,$uname);



	$selQry=mysqli_fetch_row(mysqli_query($conn,"select count(*)  from `user` where `status`='1' and `view`='1' and (`email`='$username' or `mobile`='$username' ) "));

	if($selQry[0]>0){

		return true	;

	}else{

		return false;	

	 }

	 

}

function getiforderhascid($conn,$oid)
{
	$execQry=mysqli_query($conn,"select * from `newshoppingcart` where `aid`='$oid' and `catid`!='0' ");
	$num=mysqli_num_rows($execQry);
	$fetch=mysqli_fetch_row($execQry);

	return $num; 
	
	
	
}
function getcontypefromorderid($conn,$oid)
{
	$execQry=mysqli_query($conn,"select `contype` from `orders` where `id`='$oid'");
	//$num=mysqli_num_rows($execQry);
	$fetch=mysqli_fetch_row($execQry);

	return $fetch[0]; 
	
	
	
}
function insertexpiryintotables($conn,$contype,$userid,$exp)
{
	if($contype=="1")
	{
		
			$execQry=mysqli_query($conn,"update `user` set `expiry`='$exp' where `id`='$userid'");

		
		 
	} 
	
	else
	{
		$execQry=mysqli_query($conn,"update `members` set `subexpiry`='$exp' where `id`='$userid'");
	
		
		
	}
	
}
function gettopTxnId($conn,$id){

	 $expId=explode("LPTH",$id);

	$getId=$expId[1];

	$evtid=$getId-1000;

	return $evtid; 

}

function getecomexpirydateofmember($conn,$id)
{
	
$sqlQry=mysqli_query($conn,"select `ecomexpiry` from `members` where `id` ='$id' and `ecomstatus`='1' and `status`='1'");
//echo "select `ecomexpiry` from `members` where `id` ='$id' and `ecomstatus`='1' and `status`='1'";	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getexpirydateoftopayment($conn,$id)
{
	
$sqlQry=mysqli_query($conn,"select `topexpiry` from `members` where `id`='$id'");
//echo "select `baseexpiry` from `members` where `id` ='$id' and `basefeestatus`='1' and `status`='1'";	
$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getprofessionnameforfilter($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `title` from `books` where `id` ='$id' and `status`='1' and `view`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getctgrynamebycid($conn,$id)
{//echo "select `name` from `basemng` where `id` ='$id' and `status`='1' and `view`='1'";
$sqlQry=mysqli_query($conn,"select `name` from `basemang` where `id` ='$id' and `status`='1' and `view`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getmemberdateofexpiry($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `baseexpiry` from `members` where `id` ='$id' and `basefeestatus`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getecomctgnamebyd($conn,$id){

$sqlQry=mysqli_query($conn,"select `name` from `ecomctg` where `id` ='$id'");
	//echo "select `name` from `basemng` where `id` ='$id'";
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getmemberecomidbytexnid($conn,$id){

$sqlQry=mysqli_query($conn,"select `memberid` from `ecompay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getecompdate($id){

$sqlQry=mysqli_query($conn,"select `pdate` from `ecompay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getecomTxnId($conn,$id){

	$expId=explode("LPSHOP",$id);

	$getId=$expId[1];

	$evtid=$getId-1000;

	return $evtid; 

}


function getecomstatus($conn,$id){
	$sqlQry=mysqli_query($conn,"select `ecomstatus` from `members` where `id`='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}
function getecomId($conn,$id){

	$val=1000+$id;

	return "LPSHOP".$val;

}

function getmemberecomDetailById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `ecompay` where `id` ='$id'"));

	return $fetchRes;

}


function getimageofmemberbymemid($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `imagepath` from `members` where `id` ='$id' ");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];	
}

function getexpiryecomdateofmember($conn,$id)
{
	
$sqlQry=mysqli_query($conn,"select `ecomexpiry` from `members` where `id` ='$id' and `ecomstatus`='1' and `status`='1'");
//echo "select `ecomexpiry` from `members` where `id` ='$id' and `ecomstatus`='1' and `status`='1'";	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getorderfromid($conn,$id){
$query=mysqli_query($conn,"select * from `orders` where `id`='$id' and `status`='1'");
$result=mysqli_fetch_array($query);

return $result;

}

function getecomctgrynamebycid($conn,$id)
{//echo "select `name` from `ecomctg` where `id` ='$id' and `status`='1' and `view`='1'";
$sqlQry=mysqli_query($conn,"select `name` from `ecomctg` where `id` ='$id' and `status`='1' and `view`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getsafdetails($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `basepay` where `id` ='$id'  "));

	return $fetchRes;

}

function getexpirydateofmember($conn,$id)

{
$sqlQry=mysqli_query($conn,"select `baseexpiry` from `members` where `id` ='$id' and `basefeestatus`='1' and `status`='1'");
//echo "select `baseexpiry` from `members` where `id` ='$id' and `basefeestatus`='1' and `status`='1'";	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getbasefeepaymentDetailById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `basepay` where `id` ='$id'  "));

	return $fetchRes;

}


function getmnthsexpiry($conn,$id){

$sqlQry=mysqli_query($conn,"select `month` from `basemang` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}
function getbasecategorydetails($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `basemang` where `id` ='$id'  "));

	return $fetchRes;

}


function getDateFormat($conn,$date){

	$expdate=explode("/",$date);

	$newdate=$expdate[2]."-".$expdate[0]."-".$expdate[1];

	return $newdate; 

}

function getecomcategoryamountbycid($conn,$id)
{//echo "select `name` from `basemng` where `id` ='$id' and `status`='1' and `view`='1'";
$sqlQry=mysqli_query($conn,"select `fees` from `ecomctg` where `id` ='$id' and `status`='1' and `view`='1'");
	
	$fetchQry=mysqli_fetch_row($conn,$sqlQry);
return $fetchQry[0];

}
function getoptionalstatus($conn,$id){
	$sqlQry=mysqli_query($conn,"select `optionalstatus` from `members` where `id`='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getbasefees($conn){
	$sqlQry=mysqli_query($conn,"select `base` from `fees` where `id`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}


function getbasefeestatus($conn,$id){
	$sqlQry=mysqli_query($conn,"select `basefeestatus` from `members` where `id`='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getcategoryamountbycid($conn,$id)
{//echo "select `name` from `basemng` where `id` ='$id' and `status`='1' and `view`='1'";
$sqlQry=mysqli_query($conn,"select `fees` from `basemang` where `id` ='$id' and `status`='1' and `view`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getemailidofmemberbyuid($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `email` from `members` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function invoicegenerateforoptionalfeesmember($conn,$baseurl,$uid,$basefeeid)
{
$exexQry=mysqli_fetch_row(mysqli_query($conn,"select * from `optionalpay` where `memberid`='$uid' and `id`='$basefeeid'"));
 $pdate=$exexQry[5];
 $amount=$exexQry[4];
 $servicecharge=$exexQry[3];
 $price=$exexQry[2];
 $valid=getoptionalexpirydateofmember($conn,$uid);
 $cate='Content Publishing';
$membername=getMemberNameById($conn,$uid);
 $service=getbaseservicetax($conn,$id);
$date1=changeToStdDate($conn,$pdate);
$valid1=changeToStdDate($conn,$valid);
$phoneno=getAdminPhoneNumber($conn);
$adminmail=getAdminDisplayEmail($conn);
$msg='<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Content Publishing Fees Payment</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/example.js"></script>
<style>
#hiderow,
.delete {
  display: none;
}
/*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/
* { margin: 0; padding: 0; }
body { font: 14px/all-petite-caps Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }
textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }
#header {background:#0b4d97 none repeat scroll 0 0;
    color: white;
    font: bold 15px Times New Roman,Georgia,serif;
    height: 15px;
    letter-spacing: 2px;
    margin: 20px 0;
    padding: 8px 0;
    width: 100%;
    word-spacing: 10px; }
#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }
#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 6px 50px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 5px; border-bottom: 1px solid black; 

padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { 

background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 

0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>
</head>
<body>
<div id="page-wrap">
	<div id="header" style="text-align:center">Credit Purchasing Payment Invoice</div>
		<div id="identity">
		    <div id="logo">
		<img id="image" src="'.$baseurl.'/img/logo/logo.png" alt="logo" />
        </div>
		</div>
		<div style="clear:both"></div>
		<div id="customer">
		<table id="meta">
                <tr>
                    <td class="meta-head">Member Name</td>
                    <td>'.$membername.' </td>
                </tr>
                <tr>
                    <td class="meta-head">Payment Date</td>
                    <td>'.$date1.'</td>
                </tr>
                <tr>
                <td class="meta-head">Valid Till</td>
                    <td>'.$valid1.'</td>
                </tr>
	    </table>
		</div>
		<table id="items">
		<tr>
		      <th width="183">Payment For </th>
		      <th width="308">Charges</th>
		      <th width="88">GST</th>
			  <th width="100">GST Charges</th>
		     		  </tr>
		  <tr class="item-row">
		      <td class="item-name" align="center"><div class="delete-wpr">'.$cate.'</div></td>
		      <td class="description" align="center">'.$price.'</td>
		      <td align="center">'.$service.'%</td>
			  <td align="center">Rs. '.$servicecharge.'</td>
			  
		     
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Subtotal</td>
		      <td width="99" class="total-value"><div id="subtotal">Rs. '.$amount.'</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Amount Paid</td>
		      <td class="total-value">Rs. '.$amount.'</td>
		  </tr>
		</table>
 <div id="terms">
	    <h5>The Silverlining</h5>
        <p>If you have any queries you can call us at : '.$phoneno.' </p>
        <p>or write to us at </p>
        '.$adminmail.'
	  </div>
	
	</div>
</body></html>';
return $msg;

}

function invoiceecomgenerateformember($conn,$baseurl,$uid,$basefeeid)
{
$exexQry=mysqli_fetch_row(mysqli_query($conn,"select * from `ecompay` where `memberid`='$uid' and `id`='$basefeeid'"));
  $cid=$exexQry[2];
 $pdate=$exexQry[4];
 $amount=$exexQry[3];
 $valid=getecomexpirydateofmember($conn,$uid);
$charge=getecomcategoryamountbycid($conn,$cid);
 $cate=getecomctgrynamebycid($conn,$cid);

$membername=getMemberNameById($conn,$uid);

 $service=getbaseservicetax($conn,$id);
 $sub1=($charge*$service)/100;
 $sub=$charge+ceil($sub1);
$date1=changeToStdDate($conn,$pdate);
$valid1=changeToStdDate($conn,$valid);
$phoneno=getAdminPhoneNumber($conn);
$adminmail=getAdminDisplayEmail($conn);
$msg='<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>TSL Shop Invoice</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/example.js"></script>
<style>
#hiderow,
.delete {
  display: none;
}
/*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/

* { margin: 0; padding: 0; }
body { font: 14px/all-petite-caps Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header {background:#0b4d97 none repeat scroll 0 0;
    color: white;
    font: bold 15px Times New Roman,Georgia,serif;
    height: 15px;
    letter-spacing: 2px;
    margin: 20px 0;
    padding: 8px 0;
    width: 100%;
    word-spacing: 10px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }


#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 6px 50px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 5px; border-bottom: 1px solid black; 

padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { 

background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 

0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>
</head>
<body>
<div id="page-wrap">
	<div id="header" style="text-align:center">Tsl Shop Payment Invoice</div>
		<div id="identity">
		    <div id="logo">
		<img id="image" src="'.$baseurl.'/img/logo/logo.png" alt="logo" />
        </div>
		</div>
		<div style="clear:both"></div>
		<div id="customer">
		<table id="meta">
                <tr>
                    <td class="meta-head">Member Name</td>
                    <td>'.$membername.' </td>
                </tr>
                <tr>
                    <td class="meta-head">Payment Date</td>
                    <td>'.$date1.'</td>
                </tr>
                <tr>
                <td class="meta-head">Valid Till</td>
                    <td>'.$valid1.'</td>
                </tr>
	    </table>
		</div>
		<table id="items">
		<tr>
		      <th width="183">Payment For </th>
		      <th width="308">Subscrption Plan</th>
		      <th width="88">Charges</th>
		      <th width="100">Service Tax</th>
			  		  </tr>
		  <tr class="item-row">
		      <td class="item-name" align="center"><div class="delete-wpr">Tsl Shop Subscription Plan</div></td>
		      <td class="description" align="center">'.$cate.'</td>
		      <td>Rs. '.$charge.'</td>
		      <td align="center">'.$service.'%</td>
		     
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Subtotal</td>
		      <td width="99" class="total-value"><div id="subtotal">Rs. '.$sub.'</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Amount Paid</td>
		      <td class="total-value">Rs. '.$amount.'</td>
		  </tr>
		</table>
 <div id="terms">
	    <h5>LifePositive</h5>
        <p>If you have any queries you can call us at : '.$phoneno.' </p>
        <p>or write to us at </p>
        '.$adminmail.'
	  </div>
	
	</div>
	<div id="terms">
	  
        <p style="
    font-size:  13px;
    color: #3f459c;
"> This is a system generated email.Please do not  reply to this email.
        
	</div>
</body></html>';
return $msg;

}


function getAdminPhoneNumber($conn){
$sqlQry=mysqli_query($conn,"select `contact` from `admin` where `id`='1'");
$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}
function getAdminMail($conn){
	$execQry=mysqli_fetch_row(mysqli_query($conn,"select `email` from `admin` where `id`=1 "));
	return $execQry[0];
}

function getAdminDisplayEmail($conn){



	$sqlQry=mysqli_query($conn,"select `displayemail` from `admin` where `id`='1'");



	$fetchQry=mysqli_fetch_row($sqlQry);



	return $fetchQry[0];



}

function invoicegenerateformember($conn,$baseurl,$uid,$basefeeid)
{
$exexQry=mysqli_fetch_row(mysqli_query($conn,"select * from `basepay` where `memberid`='$uid' and `id`='$basefeeid'"));
  $cid=$exexQry[2];
 $pdate=$exexQry[4];
 $amount=$exexQry[3];
 $valid=getexpirydateofmember($conn,$uid);
$charge=getcategoryamountbycid($conn,$cid);
 $cate=getctgrynamebycid($conn,$cid);

$membername=getMemberNameById($conn,$uid);

 $service=getbaseservicetax($conn,$id);
 $sub1=($charge*$service)/100;
 $sub=$charge+floor($sub1);
$date1=changeToStdDate($conn,$pdate);
$valid1=changeToStdDate($conn,$valid);
$phoneno=getAdminPhoneNumber($conn);
$adminmail=getAdminDisplayEmail($conn);
$msg='<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Base Fees Invoice</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/example.js"></script>
<style>
#hiderow,
.delete {
  display: none;
}
/*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/

* { margin: 0; padding: 0; }
body { font: 14px/all-petite-caps Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header {background:#0b4d97 none repeat scroll 0 0;
    color: white;
    font: bold 15px Times New Roman,Georgia,serif;
    height: 15px;
    letter-spacing: 2px;
    margin: 20px 0;
    padding: 8px 0;
    width: 100%;
    word-spacing: 10px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }


#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 6px 50px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 5px; border-bottom: 1px solid black; 

padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { 

background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 

0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>
</head>
<body>
<div id="page-wrap">
	<div id="header" style="text-align:center">Base Fees Payment Invoice</div>
		<div id="identity">
		    <div id="logo">
		<img id="image" src="'.$baseurl.'/img/logo/logo.png" alt="logo" />
        </div>
		</div>
		<div style="clear:both"></div>
		<div id="customer">
		<table id="meta">
                <tr>
                    <td class="meta-head">Member Name</td>
                    <td>'.$membername.' </td>
                </tr>
                <tr>
                    <td class="meta-head">Payment Date</td>
                    <td>'.$date1.'</td>
                </tr>
                <tr>
                <td class="meta-head">Valid Till</td>
                    <td>'.$valid1.'</td>
                </tr>
	    </table>
		</div>
		<table id="items">
		<tr>
		      <th width="183">Payment For </th>
		      <th width="308">Subscrption Plan</th>
		      <th width="88">Charges</th>
		      <th width="100">GST</th>
			  		  </tr>
		  <tr class="item-row">
		      <td class="item-name" align="center"><div class="delete-wpr">Base Fees Subscription Plan</div></td>
		      <td class="description" align="center">'.$cate.'</td>
		      <td>Rs. '.$charge.'</td>
		      <td align="center">'.$service.'%</td>
		     
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Subtotal</td>
		      <td width="99" class="total-value"><div id="subtotal">Rs. '.$sub.'</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Amount Paid</td>
		      <td class="total-value">Rs. '.$amount.'</td>
		  </tr>
		</table>
 <div id="terms">
	    <h5>LifePositive</h5>
        <p>If you have any queries you can call us at : '.$phoneno.' </p>
        <p>or write to us at </p>
        '.$adminmail.'
	  </div>
	
	</div>
	<div id="terms">
	  
        <p style="
    font-size:  13px;
    color: #3f459c;
"> This is a system generated email.Please do not  reply to this email.
        
	</div>
</body></html>';
return $msg;

}


function sendBasicMail_OLD($to,$from,$fromname,$subject,$msg){

$url = 'https://api.elasticemail.com/v2/email/send';

try{
       $post = array('from' => 'support@thesilverlining.co.in',
                     'fromName' => 'Life Positive',
                    'apikey' => '77d65f66-f14b-4260-b980-37e9f6cb6e0b',
                     'subject' => $subject,
                     'bodyHtml' => $msg,
                     //'bodyText' => $message,
                     'isTransactional' => true,
 		'to'=>$to,
                    );
        
       $ch = curl_init();
           
       curl_setopt_array($ch, array(
           CURLOPT_URL => $url,
           CURLOPT_POST => true,
           CURLOPT_POSTFIELDS => $post,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HEADER => false,
           CURLOPT_SSL_VERIFYPEER => false
       ));
       
       $result=curl_exec ($ch);
       curl_close ($ch);
       
     
}
catch(Exception $ex){
   echo $ex->getMessage();
}
}
function getbamountcreditreductionaccpet($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `damount` from `creditdeductionaccept` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getuserdetailfrchatusertable($conn,$id)
{
		$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `user` where `status` ='1' and `id`='$id'"));

	return $fetchRes;

}

function getuidfromquesidfromselectedhealercontect($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `uid` from `contactqueries` where `id` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getbookdetailfordedcution($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `bookings` where `id` ='$id' and `status`='1' "));

	return $fetchRes;

}

function getbamountcreditreductionbooking($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `bookingamount` from `creditdeduction` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}
function getbookiidtodedudctamouotn($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `bookingid` from `creditdeduction` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getuidfromquesidfromselectedhealer($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `uid` from `seekercase` where `id` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getchatidtodedudctamouotn($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `bookingid` from `creditdeductionaccept` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getchatidtodedudctamouotnchatting($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `bookingid` from `creditdeductionacceptnew` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function getbamountcreditreductionaccpetnewseekercase($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `damount` from `creditdeductionacceptnew` where `creditpayid` ='$id' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getcreditstatus($conn,$id){
	$sqlQry=mysqli_query($conn,"select `creditstatus` from `members` where `id`='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getdeebitamountfromcreditpaytable($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `deduct` from `creditpay` where `id` ='$id' ");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];	

}
function getcreditamountofmember($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `creditamount` from `members` where `id` ='$id' and `creditstatus`='1' and `status`='1'");
//echo "select `ecomexpiry` from `members` where `id` ='$id' and `ecomstatus`='1' and `status`='1'";	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function invoicegenerateforvreditpurchasemember($conn,$baseurl,$uid,$basefeeid)
{
$exexQry=mysqli_fetch_row(mysqli_query($conn,"select * from `creditpay` where `memberid`='$uid' and `id`='$basefeeid'"));
 $quantity=$exexQry[3];
 $pdate=$exexQry[8];
 $amount=$exexQry[6];
$charge=$exexQry[2];
$serv=$exexQry[5];
$mulprice=$exexQry[4];
$membername=getMemberNameById($conn,$uid);

 $service=getbaseservicetax($conn,$id);
 $date1=changeToStdDate($conn,$pdate);
$phoneno=getAdminPhoneNumber($conn);
$adminmail=getAdminDisplayEmail($conn);
$msg='<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Credit Purchasing Invoice</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/example.js"></script>
<style>
#hiderow,
.delete {
  display: none;
}
/*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/

* { margin: 0; padding: 0; }
body { font: 14px/all-petite-caps Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header {background:#0b4d97 none repeat scroll 0 0;
    color: white;
    font: bold 15px Times New Roman,Georgia,serif;
    height: 15px;
    letter-spacing: 2px;
    margin: 20px 0;
    padding: 8px 0;
    width: 100%;
    word-spacing: 10px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }


#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 6px 50px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 5px; border-bottom: 1px solid black; 

padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { 

background-color:#EEFF88; }


.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 

0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>
</head>
<body>
<div id="page-wrap">
	<div id="header" style="text-align:center">Credit Purchasing Payment Invoice</div>
		<div id="identity">
		    <div id="logo">
		<img id="image" src="'.$baseurl.'/img/logo/logo.png" alt="logo" />
        </div>
		</div>
		<div style="clear:both"></div>
		<div id="customer">
		<table id="meta">
                <tr>
                    <td class="meta-head">Member Name</td>
                    <td>'.$membername.' </td>
                </tr>
                <tr>
                    <td class="meta-head">Payment Date</td>
                    <td>'.$date1.'</td>
                </tr>
               
	    </table>
		</div>
		<table id="items">
		<tr>
		      <th width="183">Payment For </th>
		      <th width="308">Charges</th>
		      <th width="88">Quantity</th>
		      <th width="100">Total Amount</th>
			  		  </tr>
		  <tr class="item-row">
		      <td class="item-name" align="center"><div class="delete-wpr">Credit Purchasing</div></td>
		      <td class="description" align="center">Rs.'.$charge.'</td>
		      <td align="center"> '.$quantity.'</td>
		      <td align="center">Rs. '.$mulprice.'</td>
		     
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">GST % '.$service.'</td>
		      <td width="99" class="total-value"><div id="subtotal">Rs. '.$serv.'</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line">Amount Paid</td>
		      <td class="total-value">Rs. '.$amount.'</td>
		  </tr>
		</table>
 <div id="terms">
	    <h5>The Silverlining</h5>
        <p>If you have any queries you can call us at : '.$phoneno.' </p>
        <p>or write to us at </p>
        '.$adminmail.'
	  </div>
	
	</div>
	<div id="terms">
	  
        <p style="
    font-size:  13px;
    color: #3f459c;
"> This is a system generated email.Please do not  reply to this email.
        
	</div>
</body></html>';
return $msg;

}

function getoptionalid($conn,$id){

	$val=1000+$id;

	return "LPOPTIONAL".$val;

}

function getoptionaldefaultamount($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `fees` from `additionalfees` where `id` ='2' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getRoleNameById($conn,$id){







$execQry=mysqli_query($conn,"select `name` from `roles` where `id`='$id' ");



$fetchRes=mysqli_fetch_row($execQry);



return $fetchRes[0];



}
function getcreditpaydiddetails($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `creditpay` where `id` ='$id'  "));

	return $fetchRes;

}

function getbasedefualtamountbyid($conn,$id)
{//echo "select `name` from `basemng` where `id` ='$id' and `status`='1' and `view`='1'";
$sqlQry=mysqli_query($conn,"select `fees` from `basemang` where `id` ='1' and `status`='1' and `view`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getcreditdefaultamount($conn,$id)
{
$sqlQry=mysqli_query($conn,"select `fees` from `additionalfees` where `id` ='1' and `status`='1'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}



function totalamountcreditbymember($conn,$id)
{
$result=mysqli_query($conn,"SELECT sum( mulprice ) as value_sum FROM `creditpay` WHERE `view` = '1' AND `status` = '1' AND `type`='1' and `memberid`='$id'");
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
return $sum;
}

function totalamountcreditbymemberadmin($conn,$id)
{
$result=mysqli_query($conn,"SELECT sum( mulprice ) as value_sum FROM `creditpay` WHERE `view` = '1' AND `status` = '1' AND `type`='2' and `memberid`='$id'");
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
return $sum;
}

function getecomcategorydetails($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `ecomctg` where `id` ='$id'  "));

	return $fetchRes;

}
function getcid($conn,$id){

$sqlQry=mysqli_query($conn,"select `cid` from `basepay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getcidfromecompayofmember($conn,$id)
{
$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `ecompay` where `id` ='$id' and `status`='1' and `view`='1'"));
return $fetchRes;

}
function getoptionalTxnId($conn,$id){

	$expId=explode("LPOPTIONAL",$id);

	$getId=$expId[1];

	$evtid=$getId-1000;

	return $evtid; 

}
function getoptionalmnthsexpiry($conn){

$sqlQry=mysqli_query($conn,"select `month` from `additionalfees` where `id` ='2'");
	
	$fetchQry=mysqli_fetch_row($conn,$sqlQry);
return $fetchQry[0];
}

function getmemberidbytexnidoptional($conn,$id){

$sqlQry=mysqli_query($conn,"select `memberid` from `optionalpay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}
function getmemberidbytexnidcredit($conn,$id){

$sqlQry=mysqli_query($conn,"select `memberid` from `creditpay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}


function getecommnthsexpiry($conn,$id){

$sqlQry=mysqli_query($conn,"select `month` from `ecomctg` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}
function getmemberoptionalfeeDetailById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `optionalpay` where `id` ='$id'"));

	return $fetchRes;

}
function getoptionalexpirydateofmember($conn,$id)
{
	
$sqlQry=mysqli_query($conn,"select `optionalexpiry` from `members` where `id` ='$id' and `optionalstatus`='1' and `status`='1'");
//echo "select `baseexpiry` from `members` where `id` ='$id' and `basefeestatus`='1' and `status`='1'";	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}
function getoptionaldetails($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `additionalfees` where `id` ='2' and `status`='1' "));

	return $fetchRes;

}

function gethealergallerycount($conn,$memid)
{
	
$query=mysqli_query($conn,"select * from `healergallery` where `status`='1' and `view`='1' and `conid`='$memid'");	

	$num=mysqli_num_rows($query);
	return $num;
	
}
function getotheraddresscount($conn,$memid)
{
	$query=mysqli_query($conn,"select * from `clinicaddress` where `mem_id`='$memid'");
	$num=mysqli_num_rows($query);
	return $num;
	
	
}

function getarticlescountbyid($conn,$userid)
{
	$query=mysqli_query($conn,"select * from `wellness` where `contributed`='$userid' and `status`='1'");
	$num=mysqli_num_rows($query);
	return $num;
	
	
}

function geteventscountbyid($conn,$userid)
{
	
	$sqlQry=mysqli_query($conn,"select * from `events` where `view`='1' and `status`='1' and `contributed`='$userid' ");
	$num=mysqli_num_rows($sqlQry);
	return $num;
	
}

function getwrittenreviewcountbyid($conn,$userid)
{
	$sqlQry=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$userid' and `status`='1' and `type`='1' ");
	$num=mysqli_num_rows($sqlQry);
	return $num;
	
} 
function getwrittenvideoreviewcountbyidworkshop($conn,$userid)
{
	$sqlQry=mysqli_query($conn,"select * from `eventrating` where `event_id`='$userid' and `status`='1' and `type`='1' ");
	$num=mysqli_num_rows($sqlQry);
	return $num;
	
} 




function getvideoreviewcountbyid($conn,$userid)
{
	
	$sqlQry=mysqli_query($conn,"select * from `memberstar` where `mem_id`='$userid' and `status`='1' and `type`='2' ");
	$num=mysqli_num_rows($sqlQry);
	return $num;
	
}
function getvideoreviewcountworkshopbyid($conn,$userid)
{
	
	$sqlQry=mysqli_query($conn,"select * from `eventrating` where `event_id`='$userid' and `status`='1' and `type`='2' ");
	$num=mysqli_num_rows($sqlQry);
	return $num;
	
}


function getdistinctlocationid($conn,$lat,$long)
{
	
	$searchq=mysqli_query($conn,"select `id` from `locationsearch` where `latitude`='$lat' and `longitude`='$long'");
	
	$result=mysqli_fetch_row($searchq);
	return $result[0];
}


function getalllocationsearchdetails($conn,$id)
{
	
	$searchq=mysqli_query($conn,"select * from `locationsearch` where `id`='$id' ");
	
	$result=mysqli_fetch_row($searchq);
	return $result;
}
function getMemberShortNameById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query("select * from `members` where `id` ='$id' "));

	$name=getTabledataById($conn,"name","titles",$fetchRes[1])." ".$fetchRes[2];

	return $name;	

}
function getserviceidfromlatlong($conn,$llat1,$llong1)
{
	
	
	$searchq=mysqli_query($conn,"select `serviceid` from `locationsearch` where `latitude`='$llat1' and `longitude` ='$llong1'");
	
	$result=mysqli_fetch_row($searchq);
	return $result[0];
	
	
}
function getecomcid($conn,$id){

$sqlQry=mysqli_query($conn,"select `cid` from `ecompay` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];
}

function getecompaymentDetailById($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `ecompay` where `id` ='$id'  "));

	return $fetchRes;

}


function gethealerfilterbudgetfromid($conn,$id){

	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select * from `budget` where `id` ='$id'  "));

	return $fetchRes;

}

function getallarticlecategoryids($conn)
{
	
	
	$execQry=mysqli_query($conn,"select * from `wellness`");
 $numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){




			$eventids[]=$fetch['cat_id'];

		



		} }else{
		


			$eventids[]=0;



		}


	return $eventids;
	
}
function getpProfessionslugByid($conn,$id){


	$slug=trim($slug);
	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `slug` from `books` where `id`='$id' and `status` ='1' and `view`='1'" ));


	return 	$resultSet[0];



}
function geteventmaincontibuter($conn,$id){


	$slug=trim($slug);
	$resultSet=mysqli_fetch_row(mysqli_query($conn,"select `contributed` from `events` where `id`='$id' "));


	return 	$resultSet[0];



}
function getarticleidsfromcategoryidss($conn,$id)
{
	//echo "select * from `wellnesstag` where `tag_id` ='$id'";
	
		$execQry=mysqli_query($conn,"select * from `wellness` where `cat_id` ='$id' where `status`");
	 	$num=mysqli_num_rows($execQry);
		
		if($num>=1)
		{
		while($fetch=mysqli_fetch_array($execQry)){



			$contentId[]=$fetch['id']; 



		}

		}
		
		
		else
		{
						$contentId='0';

			
			
		}
		
		
		return $contentId;
		
}

function getMemberProfileImage($conn,$id){



	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `imagepath` from `members` where `id` ='$id' "));



	$name= $fetchRes[0];



	return $name;	



}

function getworkshopdistinctlocationid($conn,$lat,$long)
{
	$searchq=mysqli_query($conn,"select `id` from `workshoplocationsearch` where `latitude`='$lat' and `longitude`='$long'");
	
	$result=mysqli_fetch_row($searchq);
	return $result[0];
}


function getworkshopalllocationsearchdetails($conn,$id)
{
	$searchq=mysqli_query($conn,"select * from `workshoplocationsearch` where `id`='$id' ");
	
	$result=mysqli_fetch_row($searchq);
	return $result;
}

function mostcommonserachcount($conn,$proid,$lat,$long)
{
	
	$num=0;
//	echo "select distinct `latitude`,`longitude` from `locationsearch` where `serviceid`='$proid' order by `id` desc";
	$searchq=mysqli_query($conn,"select distinct `latitude`,`longitude` from `locationsearch` where `serviceid`='$proid' order by `id` desc");
									
							while($searchresult=mysqli_fetch_array($searchq))
							{	
								$llat=$searchresult[0];
								$llong=$searchresult[1];

									$lid=getdistinctlocationid($conn,$llat,$llong);
$locationdetails=getalllocationsearchdetails($conn,$lid);
$address=$locationdetails[5];
							//$address=$searchresult['address'];	
							$myArray = explode(',', $address);
$location_name=$myArray[0];
     $distance=getDistanceBetweenPointsNew($lat, $long, $locationdetails[1], $locationdetails[2]);
  if($distance<=20)
  {
	  
	  $num++;
	  
  }
	
}
return $num;
}
function getsubsexpiryfromuserid($conn,$id,$type)
{
	if($type==1)
	{
		//echo "select `expiry` from `user` where `id`='$id' ";
	$searchq=mysqli_query($conn,"select `expiry` from `user` where `id`='$id' ");
	}
	
	else
	{
		
		$searchq=mysqli_query($conn,"select `subexpiry` from `members` where `id`='$id' ");
	
	}
	$result=mysqli_fetch_row($searchq);
	return $result[0];
	
	
}
function gettopweekbudgetfromtable()
{
	
	$searchq=mysqli_query($conn,"select `amount` from `topweekbudget` ");
	
	
	$result=mysqli_fetch_row($searchq);
	return $result[0];
	
}

function getallmemprofidfrommemid($conn,$id)
{
	

	$mainProf=mysqli_query($conn,"select `prof_id` from  `memberprofession` where `mem_id`='$id'"	);
	
	while($result=mysqli_fetch_array($mainProf))
	{
		
		
	$allproids[]=$result['prof_id'];	
		
		
		
	}
	
	return $allproids;
	
}

function getcountfortophealersdisplay($conn,$allhealersstring)
{
	$experts=explode(",",$allhealersstring);
	//print_r($experts);
	$date2=date("Y-m-d");
	foreach($experts as $healers)
	{
	
	
	 $date1=getexpirydateoftopayment($conn,$healers);
	
	if($date1!="")
	{
		if($date1>=$date2)
		{
			
			
			
		$result[]=$healers;	
			
			
			
		}
		
		
		
	}
	
	
	}
	$cc=count($result);
	
	return $cc;
	
}

function callogdetails($conn,$callid)
{
	
	$query=mysqli_query($conn,"select * from `sessionstatus` where `qid`='$callid' order by `id` desc");
	$result=mysqli_fetch_array($query);
	return $result;
	
	
}

function getarticleidpostedbymember($conn,$id)

{
	//echo $curDate = date("Y-m-d");
	//echo "select * from `events`  where `status`='1' and `view`='1' ";
	$execQry=mysqli_query($conn,"select * from `wellness`  where `status`='1' and `view`='1' and `contributed`='$id' ");
$numRows=mysqli_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysqli_fetch_array($execQry)){
			$eventid[]=$fetch['id'];
			
}

if(count($eventid)>0)
			{		
	$includedeventid=implode(",",$eventid);

}
else
{
	$includedeventid="0";
	}
	}
	else{$includedeventid="0";
	}

	return $includedeventid;
	
	}
	
	
	function getsessionstatusdetailsbyid($conn,$id)
{
	//echo "select `options` from `books` where `id` = '$id'";
	//echo "select `anoymous` from `seekercase` where `id` = '$id' ";
	//echo "select * from `sessionstatus` where `id` = '$id' ";
	$execQry=mysqli_query($conn,"select * from `sessionstatus` where `id` = '$id' ");
	$fetch=mysqli_fetch_array($execQry);

	return $fetch;
}
	
function  sendsessionConfirmationMail($conn,$baseurl,$bid,$reason,$fees,$bookingdate,$tools){
	
$bookingArr=getsessionstatusdetailsbyid($conn,$bid);

$username=getUserNameById($conn,$bookingArr[12]);

$cname=getMemberNameById($conn,$bookingArr[11]);

$bookingdate=$bookingArr[2];
$bookingtime=$bookingArr[3];

$sessiondate=changeToStdDate($conn,$bookingArr[2]);

 $cimg=getMemberProfileImage($conn,$bookingArr[11]);
$fees=$bookingArr[4];

//$sessiontype=getSessionTypeNameById($bookingArr[3]);

//$of=getSearchHeadings($bookingArr[10],$bookingArr[11]);



$msg='<head>



	<title>New mail</title>



	</head>



<body>



<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">



            	<tr>



                	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">



                    	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">



                        	<tr>



                            	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">



 <a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="'.$baseurl.'/img/logo/logo.png" alt="Lifepositive" height=""  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a> 



                                </td>



                            </tr>



                            <tr>



                                <td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">



                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">



                                        <tr>



                                            <td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">



                                                <h3 style="color:#fff !important; background:#aa1e21; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Booking Status</h3>



                                             



                                                <br />

 												Booking  confirmed with following credentials :

												

												<table width="100%" border="0">

  										 <tr style="text-align:left;">

    <td style="font-weight:bold;">Proposed date : </td>

    <td>'.$bookingdate.'</td>

  </tr>
   <tr style="text-align:left;">

    <td style="font-weight:bold;">Proposed Time : </td>

    <td>'.$bookingtime.'</td>

  </tr>

   <tr style="text-align:left;">

    <td style="font-weight:bold;">Energy Exchange :</td>

    <td>'.$fees.'</td>

  </tr>

  <tr style="text-align:left;">

    <td style="font-weight:bold;">Tools : </td>

    <td>'.$tools.'</td>

  </tr>

  <tr style="text-align:left;">

    <td style="font-weight:bold;">Remarks (if any) : </td>

    <td>'.$reason.'</td>

  </tr>

																				</table>

					

                                               <br />

 												The booking details are  as follows :

												

												<table width="100%" border="0">

												 

  <tr><td rowspan="6"><img src="'.$baseurl.'/photos/'.$cimg.'" width="120" height="120" style="border-radius:5px;"></td></tr>

  <tr style="text-align:left;">

    <td style="font-weight:bold;">Consultant : </td>

    <td>'.$cname.'</td>

  </tr>

   <tr style="text-align:left;">

    <td style="font-weight:bold;">User :</td>

    <td>'.$username.'</td>

  </tr>

 
 
 

</table>  



                                            </td>



                                        </tr>



                                       



                                    </table>



                                </td>



                            </tr>



                            <tr>



                            	<td align="center" valign="top">



                                 	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailFooter">



                                    	<tr>



                                        	<td align="center" valign="top" class="footerContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:10px; line-height:125%;">


"This is a system generated email.Please do not  reply to this email."<br/>
The information contained in and accompanying this communication may be confidential, subject to legal privilege, or otherwise protected from disclosure, and is intended solely for the use of the intended recipient(s). 



                                               



                                               



                                            </td>



                                        </tr>



                                        <tr>



                                        	<td align="center" valign="top" style="padding-top:10px;">



                                            	<a style="color:#0073e6;text-decoration:none" href="'.$baseurl.'">lifepositive.com</a>



                                            </td>



                                        </tr>



										 <tr>



                                        	<td align="center" valign="top" style="padding-top:0px;color:#f2f2f2;">'.date("h:m:i").'</td>



                                        </tr>



                                    </table>



                                </td>



                            </tr>



                        </table>



                        



                        </td>



                        </tr>



                        </table></body><html>';



					return $msg;


}
	function getsubmcategoryidfromslug($conn,$slug)
{
	
	
	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `id` from `mcategory` where  `slug`='$slug' and `status`='1' order by `id` desc"));

	return $fetchRes[0];
	
	
}

function functiontogetetypevalueforshipping($conn)
{
	
	  
         $prodArray=$_SESSION['cart_array']["bag"];
         foreach($prodArray as $product){
          $count++;
      $e_priceval=0;  
	        $e_magval=0;      
    
//print_r($product);
             $pid=$product[0];
             
             $magtype=$product[1];
             $qty=$product[2];
             $catid=$product[3];
             $magyear=$product[4];
             
             if(($magtype=="eprice")||($magtype=="E-Magazine"))
			//if($magtype=="eprice")
             {
                 
               $e_priceval++; 
                 
             }
             
             else
              if($magtype=="pprice")
              {
                  
	        $e_magval++;      
  
            }
           
		 }
		 
		 if(($e_priceval>0) && ($e_magval==0))
		 {
			 
			return '1'; 
			 
			 
		 }
		 
		 else
		{
			
		return '2'; 	
			
		}
		 
		 
		 
}

function getsubscriptionmagimage($conn,$cid)
{
	
$execquery=mysqli_query($conn,"select `id` from `singleissue` where `cat_id`='$cid' order by `id` asc limit 0,1");

	$result=mysqli_fetch_row($execquery);
	return $result[0];
	
	
	
}

function emagazinemail($conn,$userid,$contype)
{ 
	if($contype=='1'){
	$to=getUserEmail($conn,$userid);
	$username=getUserNameById($conn,$userid);
	$tomobile=getUserMobileNumber($conn,$userid);
	}elseif($contype=='2'){
		
		$username=getMemberNameById($conn,$userid);
		$to=getmemberemailaddressId($conn,$userid);
		$tomobile=getMemberMobileNumber($conn,$userid);
	}
	
	
	$msg='<head> 

</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="https://www.lifepositive.com/img/logo/logo.png" 	alt="LifePositive" height="167"  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">

<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">Hi '.$username.',</h3>

<br />
	<table width="100%" border="0">
 	 <tr>
     <td width="81%" align="left">Kudos for purchasing our e-magazine. You can now access our magazine on-the-go. To access your copy, please follow these steps:-
<br>

<ol>
<li>Login to your account on <a href=www.lifepositive.com>www.lifepositive.com</a>, using your mobile number and password
</li><li>Click on read magazine in the menu bar of your dashboard</li>

<br>
 



</td>
</tr>

<br/>
 <tr style="text-align:left;">
 	<td style="font-weight:bold;">Happy reading!</td>
</tr>
<tr style="text-align:left;">
	<td style="font-weight:bold;">Warmly,</td>
	</tr><tr style="text-align:left;">
	<td style="font-weight:bold;">Team Life Positive</td>
	</tr><tr style="text-align:left;">
	
	</tr>

 
</table>
</td>
</tr>
	
</table> <table> <tr><td style="
    font-size:  15px;
    color: #6386ab;
">"This is a system generated email.Please do not  reply to this email."</td></tr>
</table></table></td></tr></table></body><html>';
return $msg;

	
}

function getorderconfirmmail($conn,$oid)
{
	$orderdetails=getorderfromid($conn,$oid);
	//print_r($getorderfromid);
	 $userid=$orderdetails[1];
	$contype=$orderdetails[19];
	$grand=$orderdetails[14];
	if($contype=='1'){
	$to=getUserEmail($conn,$userid);
	$username=getUserNameById($conn,$userid);
	$tomobile=getUserMobileNumber($conn,$userid);
	}elseif($contype=='2'){
		
		$username=getMemberNameById($conn,$userid);
		$to=getmemberemailaddressId($conn,$userid);
		$tomobile=getMemberMobileNumber($conn,$userid);
	}
$msg='<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>

<body>
<table style="background: #f8fcff;padding: 40px;margin: 0 auto;font-family: calibri;">
  <tr>
    <td>
      <table style="background:#FFF;width:100%;border:1px solid #84b2e0;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;">
        <!-- Logo -->
        <tr>
          <td style="padding:10px 30px;text-align:center;margin:0; border-bottom:1px solid #84b2e0">
            <p>
              <a href="#">
                 <img src="https://www.lifepositive.com/img/logo/logo.png" width="200">
                
              </a>
            </p>
          </td>
        </tr>

            
       
        <tr>
          <td style="padding:10px 30px;margin:0;text-align:left;">
            <p>Hi '.$username.',</p>
            <p>Welcome to our family. We are excited to serve you!</p>
            <p>You have have successfully completed your order</p>
          </td>
        </tr>
     
             
        
        <tr>
          <td style="padding:0px 30px;margin:0;background:#0052a5;color: #FFFFFF;">
            <table style="width:100%;padding:10px;text-align:center;">
              <tr>
                <td colspan="2" style="font-size: 22px;border-bottom: 1px solid #00468a;padding-bottom: 5px;">Here are your details</td>
              </tr>';
			  
			  
			  $query=mysqli_query($conn,"select * from `newshoppingcart` where `aid`='$oid'");
			  $numrows=mysqli_num_rows($query);
			  if($numrows>0)
			  {
			  
			  while($fetchdetails=mysqli_fetch_array($query))
			  {
				  $catid=$fetchdetails[2];
				  				  $magtype=$fetchdetails[3];

				  if($catid!='0'){
				$subTotal=0;
				$prodName=getmagazinecategorynamenew($conn,$catid);
				$prodPrice=getmagazinepricefromsession($conn,$magyear,$magtype,$catid);
				$price=$prodPrice;
				$image='2.jpg';
        		$subTotal=$prodPrice;
				
				}
				else
				{
									  				  $magtype=$fetchdetails[3];

									  $pid=$fetchdetails[1];

						$prodName=getsinglemagazinename($conn,$pid);
        $magazinearr1=singleissuedetails($conn,$pid);
					
					
				}
				$price=$fetchdetails[6];
             $msg.='<tr>
                <td style="width: 100px;border-right:1px solid #00468a;margin-right: 9px; padding: 10px;"><img style="width: 70px;box-shadow: 7px 7px 3px #003569;-webkit-box-shadow:7px 7px 3px #003569; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;" src="https://www.lifepositive.com/thumb/210_277_MjAxOC0wMi0wMyAwNzoyMDozNA==_LP%20February%202018%20Magazine.jpg"></td>
                <td style="text-align: left;padding-left: 10px;">
                 
                <table width="100%" border="0">
  <tr>
    <td>Magazine</td>
	<td>-</td>
    <td>'.$prodName.'('.$magtype.')</td>
  </tr>
  <tr>
    <td>Total</td>
		<td>-</td>

    <td>Rs '.$grand.'</td>
  </tr>
</table>

                </td>
              </tr>';
			  }}
              $msg.='
           </table>
          </td>
        </tr>
       
           
		   <tr style="background: #00508c;color:#fff;"><td style="padding:20px">
		  
		  <p style="padding:0px">With wishes for a life full of positivity,</p>
		
		  <p style="padding:0px">Seeker Happiness Team @ Life Positive</p>
		 
		  </td><tr>
		   
		   
      </table>
	       <table align="center"> <tr align="center"><td style="
    font-size:  15px;
    color: #6386ab; text-align:center
">"This is a system generated email.Please do not  reply to this email."</td></tr>
</table>
 
    </td>
  </tr>
  
  

</table>

</body>
</html>
';	
return $msg;
	
}

function mailforsubscription($conn,$oid)
{
	

	$orderdetails=getorderfromid($conn,$oid);
	//print_r($getorderfromid);
	 $userid=$orderdetails[1];
	$contype=$orderdetails[19];
	$grand=$orderdetails[14];
	if($contype=='1'){
	$to=getUserEmail($conn,$userid);
	$username=getUserNameById($conn,$userid);
	$tomobile=getUserMobileNumber($conn,$userid);
	}elseif($contype=='2'){
		
		$username=getMemberNameById($conn,$userid);
		$to=getmemberemailaddressId($conn,$userid);
		$tomobile=getMemberMobileNumber($conn,$userid);
	}
$msg='<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>

<body>
<table style="background: #f8fcff;padding: 40px;margin: 0 auto;font-family: calibri;">
  <tr>
    <td>
      <table style="background:#FFF;width:100%;border:1px solid #84b2e0;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;">
        <!-- Logo -->
        <tr>
          <td style="padding:10px 30px;text-align:center;margin:0; border-bottom:1px solid #84b2e0">
            <p>
              <a href="#">
                 <img src="https://www.lifepositive.com/img/logo/logo.png" width="200">
                
              </a>
            </p>
          </td>
        </tr>

            
       
        <tr>
          <td style="padding:10px 30px;margin:0;text-align:left;">
            <p>Hi '.$username.',</p>
            <p>Welcome to our family. We are excited to serve you!"</p>
            <p>You have have successfully subscribed to our magazines</p>
          </td>
        </tr> 
     
             
        
        <tr>
          <td style="padding:0px 30px;margin:0;background:#0052a5;color: #FFFFFF;">
            <table style="width:100%;padding:10px;text-align:center;">
              <tr>
                <td colspan="2" style="font-size: 22px;border-bottom: 1px solid #00468a;padding-bottom: 5px;">Here are your subscription details</td>
              </tr>';
			  
			  
			  $query=mysqli_query($conn,"select * from `newshoppingcart` where `aid`='$oid' and `catid`!='0'");
			  $numrows=mysqli_num_rows($query);
			  if($numrows>0)
			  {
			  
			  while($fetchdetails=mysqli_fetch_array($query))
			  {
				  $catid=$fetchdetails[2];
				  				  $magtype=$fetchdetails[3];
$duration=$fetchdetails[5];
				  if($catid!='0'){
				$subTotal=0;
				$prodName=getmagazinecategorynamenew($conn,$catid);
				$prodPrice=getmagazinepricefromsession($conn,$magyear,$magtype,$catid);
				$price=$prodPrice;
				$image='2.jpg';
        		$subTotal=$prodPrice;
				
				}
				
				$price=$fetchdetails[6];
             $msg.='<tr>
                <td style="width: 100px;border-right:1px solid #00468a;margin-right: 9px; padding: 10px;"><img style="width: 70px;box-shadow: 7px 7px 3px #003569;-webkit-box-shadow:7px 7px 3px #003569; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;" src="https://www.lifepositive.com/thumb/210_277_MjAxOC0wMi0wMyAwNzoyMDozNA==_LP%20February%202018%20Magazine.jpg"></td>
                <td style="text-align: left;padding-left: 10px;">
                 
                <table width="100%" border="0">
  <tr>
    <td>Magazine</td>
	<td>-</td>
    <td>'.$prodName.'('.$magtype.')</td>
  </tr>
  <tr>
    <td>Total</td>
		<td>-</td>

    <td>Rs '.$grand.'</td>
  </tr>
  <tr>
    <td>Duration</td>
		<td>-</td>

    <td>'.$duration.' Year</td>
  </tr>
</table>

                </td>
              </tr>';
			  }}
          $msg.='
           </table>
          </td>
        </tr>
       
           
		  <tr style="background: #00508c;color:#fff;"><td style="padding:20px">
		  <p>If you have subscribed to our print magazine, it will be delivered to you shortly by our delivery partners. If you have subscribed to our e-magazine, you may login on  <a href=www.lifepositive.com>www.lifepositive.com</a> to access the e-magazine.
</p>
		  <p style="padding:0px">With wishes for a life full of positivity,</p>
		  <p style="padding:0px">Ginny,</p>
		  <p style="padding:0px">Magazine Subscription Team @ Life Positive</p>
		  		  <p>09958733181</p>

		  </td><tr>
		   
		   
      </table>
	       <table align="center"> <tr align="center"><td style="
    font-size:  15px;
    color: #6386ab; text-align:center
">"This is a system generated email.Please do not  reply to this email."</td></tr>
</table>
 
    </td>
  </tr>
  
  

</table>

</body>
</html>
';	
return $msg;
	
	
	
}


function functocheckrecommendedarticle($conn,$tagid,$diff)
{
	$value="0";
			 $differecearray=explode(",",$diff);

	$rquery=mysqli_query($conn,"select * from `wellnesstag` where `tag_id`='$tagid'");
					 $numr=mysqli_num_rows($rquery);
					if($numr>0)
					{
						
						while($results=mysqli_fetch_array($rquery))
						{
							//print_r($differecearray);  
							 $raid=$results['q_id'];
							$radetails=getallarticledetails($conn,$raid);
							 $banner_imagepath=$radetails[1];
 $checkarticle=checkifarticleisrecommended($conn,$raid); 
 $checkstatus=checkstatusandviewofarticle($conn,$raid);
// $articlestatus=getarticlestatusfromarticleid($conn,$raid);
							 $val=in_array($raid,$differecearray);
							 
							if(($val==0) && ($checkarticle==1) && ($checkstatus==1))
							{
								$value++;
								
							}
						}
						}
	
	return $value;
}

function validateNewLoginuser($conn,$mobile,$password)
{
	$execQry=mysqli_query($conn,"select * from `user` where `password`='$password' and `mobile`='$mobile' and `status`='1'");
	 $numrows=mysqli_num_rows($execQry);
$uid=mysqli_fetch_row($execQry);
$userid=$uid[0];

	return $userid;
	
}

function webservicenoexist($conn,$mobile,$email,$logintype)
{
	
	$query1=mysqli_query($conn,"select * from `user` where `email`='$email' and `mobile`='$mobile'");

    $numrows=mysqli_num_rows($query1);
	if($numrows=="0")
	{
	if(CheckUserEmailExists($conn,$email)){
	
	
	$numrows="1";
	}
	elseif(CheckUserMobileNumberExists($conn,$mobile)){
	$numrows="1";
	
	
	}
	}
  return $numrows;
	
}
function getmemberstatusprofile($conn,$id)
{ 
$sqlQry=mysqli_query($conn,"select `status` from `members` where `id` ='$id'");
	
	$fetchQry=mysqli_fetch_row($sqlQry);
return $fetchQry[0];

}

function funtogetidfromarticletitle($conn,$articleslug)
{

	$query=mysqli_query($conn,"select `id` from `wellness` where `title`='$articleslug' and `status`='1' and `view`='1'");			

	$fetchres=mysqli_fetch_row($query);
	
	return $fetchres[0];
	
	
}
function functiontohidegetetypevalueforshipping($conn)
{
	
	 $cartcount=count($_SESSION['cart_array']["bag"]);
         $prodArray=$_SESSION['cart_array']["bag"];
         foreach($prodArray as $product){
          $count++;
      $e_priceval=0;  
	        $e_magval=0;      
    
//print_r($product);
             $pid=$product[0];
             
             $magtype=$product[1];
             $qty=$product[2];
             $catid=$product[3];
             $magyear=$product[4];
             
             if(($magtype=="eprice")||($magtype=="E-Magazine"))
			//if($magtype=="eprice")
             {
                 
               $e_priceval++; 
                 
             }
             
           }
           if($e_priceval==$cartcount)
           {
           
           return '1';
           
           
           }
		 else
         {
          return '0';
         
         
         
         }
		 
		 
}
function  creditreminderforcron($conn,$baseurl,$membername)
{
	
$msg='<head>

<title>Credit Balance Alert</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="https://www.lifepositive.com/img/logo/logo.png" 	alt="LifePositive" height=""  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px; width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
<h3 style="color:#fff !important; background:#aa1e21; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Quarterly Payment </h3>
<br />
<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">'.$membername.'</h3>

<br />
	<table width="100%" border="0">
 	 <tr style="text-align:center;"><td width="81%">Oops! Looks like your credit balance has fallen below the minimum. Please do top it up at the earliest.</td>


  </tr>


 <tr style="text-align:Center;">
	<td style="font-weight:bold;">Thankyou!</td>
	
</tr>

 
</table>
</td>
</tr>
	<tr>



                              <td align="center" valign="middle" style="padding-right:40px; padding-bottom:10px; padding-left:40px;">
<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style="border-collapse:separate !important; border-radius:3px;">
<tr>
<td>For any queries please contact :'.getAdminPhoneNumber($conn).' or drop a mail at '.getAdminDisplayEmail($conn).'</td><tr>

             </table>
			</td>
		    </tr>
		    </table>
			</td>
			</tr>
			<tr>
			<td align="center" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailFooter">
		<tr>
<td align="center" valign="top" class="footerContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:125%;">"This is a system generated email.Please do not  reply to this email."<br/> 
The information contained in and accompanying this communication may be confidential, subject to legal privilege, or otherwise protected from disclosure, and is intended solely for the use of the intended recipient(s). 

</td>
 </tr>
<tr>
<td align="center" valign="top" style="padding-top:10px;">
<a style="color:#0073e6;text-decoration:none" href="'.$baseurl.'">lifepositive.com</a>
</td>
 </tr>
<tr>
<td align="center" valign="top" style="padding-top:0px;color:#f2f2f2;">'.date("h:m:i").'</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table></body><html>';

return $msg;

}
function  optionalarticlemembermail($conn,$baseurl,$membername)
{
$msg='<head>

<title>Content Publishing</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F2F2F2;border:solid 1px #ccc;">
<tr>
	<td align="center" valign="top" id="bodyCell" style="padding:10px 20px;">
	<table border="0" cellpadding="0" cellspacing="0" id="emailContainer" style="width:600px;">
	<tr>
	<td align="center" valign="top" bgcolor="#FFFFFF" style="padding-top:10px">
	<a href="" target="_blank" title="life apple" style="text-decoration:none;"><img src="https://www.lifepositive.com/img/logo/logo.png" 	alt="LifePositive" height=""  class="logoImage" style="border:0; color:#6DC6DD !important; font-family:Helvetica, Arial, sans-serif; font-size:60px;width:300px; font-weight:bold; height:auto !important; letter-spacing:-4px; line-height:100%; outline:none; text-align:center; text-decoration:none;" /></a>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" style="padding-top:0px; padding-bottom:10px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody" style="background-color:#FFFFFF; border-collapse:separate !important; border-radius:4px;">
	<tr>
	<td align="center" valign="top" class="bodyContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:15px; line-height:150%; padding-top:40px; padding-right:40px; padding-bottom:30px; padding-left:40px; text-align:center;">
<h3 style="color:#fff !important; background:#aa1e21; font-family:Helvetica, Arial, sans-serif; font-size:18px; font-weight:bold;line-height:26px; padding:4px 0; margin:0; padding:0; text-align:center;">Publish Article </h3>
<br />
<h3 style="color:#2b95ff !important; font-family:Helvetica, Arial, sans-serif; font-size:18px;  line-height:26px; margin:0; padding:0; text-align:center;">'.$membername.'</h3>

<br />
	<table width="100%" border="0">
 	 <tr style="text-align:center;"><td width="81%">We are looking forward to your next article to publish</td>


  </tr>


 <tr style="text-align:Center;">
	<td style="font-weight:bold;">Thankyou!</td>
	
</tr>

 
</table>
</td>
</tr>
	<tr>



                              <td align="center" valign="middle" style="padding-right:40px; padding-bottom:10px; padding-left:40px;">
<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style="border-collapse:separate !important; border-radius:3px;">
<tr>
<td>For any queries please contact :'.getAdminPhoneNumber($conn).' or drop a mail at '.getAdminDisplayEmail($conn).'</td><tr>

             </table>
			</td>
		    </tr>
		    </table>
			</td>
			</tr>
			<tr>
			<td align="center" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailFooter">
		<tr>
<td align="center" valign="top" class="footerContent" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:125%;">"This is a system generated email.Please do not  reply to this email."<br/> 
The information contained in and accompanying this communication may be confidential, subject to legal privilege, or otherwise protected from disclosure, and is intended solely for the use of the intended recipient(s). 

</td>
 </tr>
<tr>
<td align="center" valign="top" style="padding-top:10px;">
<a style="color:#0073e6;text-decoration:none" href="'.$baseurl.'">lifepositive.com</a>
</td>
 </tr>
<tr>
<td align="center" valign="top" style="padding-top:0px;color:#f2f2f2;">'.date("h:m:i").'</td>
</tr>
</table>
</td>
</tr>
</table>
</td> 
</tr>
</table></body><html>';

return $msg;

}

function gethealerlistingbylatlong($conn,$lat,$long){$execQry=mysqli_query($conn,"select `id`,`latitude`,`longitude` from `members` where `latitude`!='' and `longitude`!='' and `status`='1' and `view`='1' and `imagepath`!=''"); 

		 $numRows=mysqli_num_rows($execQry); 



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){


  $distance=getDistanceBetweenPointsNew($lat, $long, $fetch['latitude'], $fetch['longitude']);
 
if($distance<=25)
{
	 $healid=$fetch['id'];
			$menuids["$healid"]=$distance;
			

}


		}



		}else{



			$menuids[]=0;



		}
//
asort($menuids);

	return $menuids;


}

function getworkshoplistbylongandlatinew($conn,$lat,$long){
		$execQry=mysqli_query($conn,"select `id`,`latitude`,`longitude` from `events` where `latitude`!='' and `longitude`!=''and  `view`='1' and `status`='1'");

		 $numRows=mysqli_num_rows($execQry);



		if($numRows>0){



		while($fetch=mysqli_fetch_array($execQry)){


 $distance=getDistanceBetweenPointsNew($lat, $long, $fetch['latitude'], $fetch['longitude']);
if($distance<=25)
{
			$eventids=$fetch['id'];
			$menuids["$eventids"]=$distance;

}

		}



		}else{



			$menuids[]=0;



		}



	asort($menuids);

	return $menuids;



}


function getothersuggestionhealerscount($conn,$memberstring,$proid)
{
	$num=0;
	$longdistance=mysqli_query($conn,"select * from `memberprofession` where `prof_id`='$proid' and `mem_id` not in ($memberstring) order by rand($mem_id)");
	
	while($result=mysqli_fetch_array($longdistance))
	{
		
		 $member=$result['mem_id'];
		$statusq=mysqli_query($conn,"select `status` from `members` where `id`='$member'");
		$rowresult=mysqli_fetch_row($statusq);
		 $statusval=$rowresult[0];
		if($statusval=="1")
		{
			$num++;
			
		}
		
		else
		{
			
		$num="0";	
			
		}
		
		
	}
	return $num;
	
}
function validateNewLogin($conn,$mobile,$password)
{
	//echo "select * from `members` where `password`='$password' and `pcontact`='$mobile'  ";
	$execQry=mysqli_query($conn,"select * from `members` where `password`='$password' and `pcontact`='$mobile'  ");
	$numrows=mysqli_num_rows($execQry); 

	return $numrows;
	
}

function getreviewformostreviewedhealers($conn)
{
	$healers=array();
	$query="SELECT count(*)as total,`mem_id` FROM `memberstar` where `status`='1' and `view`='1' group by `mem_id` having total>2 order by total desc";
	
	$execQry=mysqli_query($conn,$query);

		$numRows=mysqli_num_rows($execQry);

		if($numRows>0){

		while($fetch=mysqli_fetch_array($execQry)){
			$status=getmemberstatusprofile($conn,$fetch['mem_id']);



				if($status==1){
			$healers[]=$fetch['mem_id'];
				}
		}

		}else{

			//$menuids[]=0;

		}
		return $healers;
	
}

function gettestimonialidsforcategoryselected($conn,$cid)
{
	//echo "select * from `memberstar` where `status`='1' ,`pagetype`='0' and `type`='1'";
$query1=mysqli_query($conn,"select * from `memberstar` where `status`='1' and `pagetype`='0' and `type`='1'");
  $num=mysqli_num_rows($query1);
	while($result=mysqli_fetch_array($query1))
	{
		
		$sessionids=$result['sessionids'];
		$sessionidarr=explode(",",$sessionids);
		
		if(in_array($cid,$sessionidarr))
	
	{
	$finalids[]=$result['id'];
		
		
	}
	
	
}
return $finalids;	
	
}

function getUserim($conn,$id){



	$fetchRes=mysqli_fetch_row(mysqli_query($conn,"select `imagepath` from `user` where `id` ='$id' "));



	$name= $fetchRes[0];



	return $name;	



}

function getwellnesstagfromblogidexistence($conn,$aid,$tagid){

//echo "select * from `wellnesstag` where `q_id` ='$aid' and `tag_id` ='$tagid'";

	$fetchRes=mysqli_query($conn,"select * from `wellnesstag` where `q_id` ='$aid' and `tag_id` ='$tagid' ");

$num=mysqli_num_rows($fetchRes);

	



	return $num;	



}

function datediff($date1,$date2)
 {
	$date1=date_create($date1);
		$date2=date_create($date2);


$diff=date_diff($date1,$date2);
return $diff->format("%a"); 
	 
	 
	 
 }
 
 function getpropertwishlistvalue($conn,$userid,$prop_id)
 {
	 
	$sel=mysqli_query($conn,"select * from `property_wishlist` where `userid`='$userid' and `property_id`='$prop_id'");

$numrows=mysqli_num_rows($sel); 
	 return $numrows;
	 
	 
 }
 
 
  function getpriceRangeFromAmount($conn,$amount)
 { 
	$sel=mysqli_query($conn,"select `value` from `pricerange` where `amount` like '%$amount%'");

$numrows=mysqli_fetch_row($sel); 
	 return $numrows[0];
	 
	 
 }
 
 function getPricerangewithquery($conn,$sele_query)
 {
		$sel=mysqli_query($conn,$sele_query);
 
	 $numrows=mysqli_num_rows($sel); 
	 if($numrows>0)
	 {
		 
		 while($resultset=mysqli_fetch_array($sel))
		 {
			$price_arr[]= $resultset['ListPrice'];
			 
			 
		 }
		 
		 
	 }



	  $min=min($price_arr);
	  $new_min=($min/1000)."K";
	 	$max=max($price_arr);
		 
		 	 $new_max=($max/1000)."K";

		 
	return $new_min."##".$new_max;	 

 }
 
 
 function getlocationwiseImage($conn,$listid)
 { $baseurl="http://s1.dkddev.com/boshall";
	 
	$query=mysqli_query($conn,"select `image_url` from `mlspin_photos` where `ListingId`='$listid' and `image_url`!='' order by rand() limit 0,1");
	 
	$resultset=mysqli_fetch_row($query); 
	 
	  $imgurl=$resultset[0];
	 if($imgurl=="")
	 {
		$imgurl=$baseurl."/images/no-image.jpg"; 
		 
	 }
	  return $imgurl;
	 
 }
 
 
  function getAllimageoflistId($conn,$listid)
 {
	$query=mysqli_query($conn,"select `image_url` from `mlspin_photos` where `ListingId`='$listid'");
	 
	while($resultset=mysqli_fetch_array($query))
	{ 
	 $arr[]=$resultset['image_url'];
	 
	}
	return $arr; 
 }
 
 function getalldatesofmonth($pdate,$pyear)
{
	if($pdate=="")
	{
		
	$pdate=date('m');
	$pyear=date('Y');	
	}
	
	$list=array();
 $month = $pdate;
 $year =$pyear;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
        $listaa[]=date('Y-m-d', $time);
	
}
return $listaa;
}


function sendBasicMailSMTP($to,$from,$fromname,$subject,$msg){

	$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
				$mail = new PHPMailer();

$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "mail.s1.dkddev.com"; // SMTP server example
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;  
 $mail->From = $from;
		 $mail->FromName =$fromname;
		 $mail->AddAddress($to);                  // set the SMTP port for the GMAIL server
$mail->Username   = "support@s1.dkddev.com"; // SMTP account username example
$mail->Password   = "Tm2ax+GL78,+";        // SMTP account password example

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
echo $to; 
	 $mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}   
} 
/* Get city name*/
function getCityNameByNamePincodeStreetname($conn,$name,$ptype)
{
	$data=array();
	if($ptype=="rent")
	{
		$whereclause=" AND `PropertyType`='Rental'";
	}
	else
	{
		$whereclause = " AND `PropertyType`!='Rental'";
	}
	$sql="SELECT `City` FROM `mlspindata_master` WHERE (`City` LIKE '%$name%' OR `ZIP_CODE_4` LIKE '%$name%' OR `StreetName` like '%$name%') $whereclause";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		while ($row=$result->fetch_assoc()) {
			$data=$row;
		}
	}
	return $data;
}

/* Get city name*/

/* Millon convert*/


    function nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n/1000000000000), 2).' TN';
        elseif ($n > 1000000000) return round(($n/1000000000), 2).' BN';
        elseif ($n > 1000000) return round(($n/1000000), 2).' M';
        elseif ($n > 1000) return round(($n/1000), 2).' K';

        return number_format($n);
    }





/*end millon convert*/

/* maxmimum property listiid by city*/
function getListingIdBymaxPropertyAndCity($conn,$city)
{
	 
	  $sql="SELECT `ListingId` FROM `mlspindata_master` WHERE `ListPrice`=(SELECT max(`ListPrice`+ 0) FROM `mlspindata_master` WHERE `City` LIKE '%$city%' AND `PropertyType` != 'Rental') AND `City` LIKE '%$city%' AND `PropertyType` !='Rental'";
	  $result=$conn->query($sql);
	  if($result->num_rows>0)
	  {
	  	$listid=$result->fetch_assoc();
	  	return $listid["ListingId"];
	  }
              
}


/* end maxmimum property listiid by city*/

function sendBasicMail($to,$from,$fromname,$subject,$msg){


try{
       $post = array('from' => 'jaywangboshrealty@gmail.com',
                     'fromName' => 'BOSHALL',
                     'subject' => $subject,
                     'bodyHtml' => $msg,
                     //'bodyText' => $message,
                     'isTransactional' => true,
  'to'=>$to,
                    );
       
       $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "http://78.46.117.226/mailer/sendaws.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $post,
 CURLOPT_HTTPAUTH =>CURLAUTH_ANY,
 CURLOPT_USERPWD => "ani:ani123",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
////  echo "cURL Error #:" . $err;
} else {
// // echo $response;
}
       
     
}
catch(Exception $ex){
   echo $ex->getMessage();
}
}


//Send Register email to user and admin
function sendregisteremail($to,$subject,$msg){


try{
       $post = array('from' => 'jaywangboshrealty@gmail.com',
                     'fromName' => 'BOSHALL',
                     'subject' => $subject,
                     'bodyHtml' => $msg,
                     //'bodyText' => $message,
                     'isTransactional' => true,
                     'to'=>$to,
                    );
       
       $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "http://78.46.117.226/mailer/sendaws.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $post,
 CURLOPT_HTTPAUTH =>CURLAUTH_ANY,
 CURLOPT_USERPWD => "ani:ani123",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
////  echo "cURL Error #:" . $err;
} else {
// // echo $response;
}
       
     
}
catch(Exception $ex){
   echo $ex->getMessage();
}
}
?>
