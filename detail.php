<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");

if(isset($_GET['id']))
{
	$listid=$_GET['id'];
$property_arr=getpropertDetailsFromListId($conn,$listid);

$latitude=$property_arr['Latitude'];
$longitude=$property_arr['Longitude']; 
//print_r($property_arr); die;
$searchedcity=$property_arr['City']; 

$fullBathroom=$property_arr['BathroomsFull'];
}

 $sqfeetprice=($property_arr['ListPrice']/$property_arr['LivingArea']);
// $sqcost=number_format((float)$sqfeetprice,2, '.', '');
$sqcost=ceil($sqfeetprice);
 



 if($property_arr['LivingArea']!='')
 {
	 
	$exploded_string=explode(".",$property_arr['LivingArea']);
	$livingarea_str1=number_format($exploded_string[0]); 
	 
 }
 else
 {
	$livingarea_str1="N/A"; 
	 
 }
 
  if($property_arr['LotSizeSquareFeet']!='')
 {
	 
	$exploded_string=explode(".",$property_arr['LotSizeSquareFeet']);
	$lotsqrfeet=number_format($exploded_string[0])." sqft"; 
	 
 }
 else
 {
	$lotsqrfeet=" - sqft"; 
	 
 }
 
?>

<!DOCTYPE HTML>
<html lang="en">
		<head>
		<!--=============== basic  ===============-->
		<meta charset="UTF-8">
		<title>Boshall</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="robots" content="index, follow"/>
		<meta name="keywords" content=""/>
		<meta name="description" content=""/>
		<link rel="stylesheet" href="<?php echo $baseurl?>/css/responsive.css">
		<!--=============== css  ===============-->
		<?php include_once("header-all-pages.php");?>
          <style>
/*.box-widget-wrap.sidebar {
	position :   fixed;
	top :   15%;
	width :   29%;
}*/
.box-widget-wrap {
	margin-bottom :   30px;
}
.owl-nav button {
	position :   absolute;
	top :   32%;
	transform :   translateY(-50%);/* background :   rgba(255, 255, 255, 0.38) !important; */
}
.owl-nav .owl-prev span {
	font-size :   6em;
	color :   #939393;
	font-weight :   100;
	position :   relative;
	left :   -30px;
}
.owl-nav .owl-next span {
	font-size :   6em;
	color :   #939393;
	font-weight :   100;
	position :   relative;
	left :   30px;
}
.owl-nav button.owl-prev {
	left :   0;
}
.owl-nav button.owl-next {
	right :   0;
}
.owl-dots {
	text-align :   center;
	padding-top :   15px;
	display :   none;
}
.owl-dots button.owl-dot {
	width :   15px;
	height :   15px;
	border-radius :   50%;
	display :   inline-block;
	background :   #ccc;
	margin :   0 3px;
}
.owl-dots button.owl-dot.active {
	background-color :   #000;
}
.owl-dots button.owl-dot :  focus {
	outline :   none;
}
.btn.color-bg :  hover {
	background :   #2F3B59;
}
.tour {
	font-size :   24px;
	margin-bottom :   20px;
}
/*
.color-bg {
	width :   100%;
	border :   1px solid #4db7fe;
	border-radius :   2px;
	font-size :   18px;
	font-weight :   400;
	margin-top :   20px;
	margin-bottom :   10px;
	cursor :   pointer;
}
*/
.free {
	color :   #919191;
	font-weight :   500;
}
</style>
          <!--  header end -->
          <style>
		  
		  .morecontent span {
    display :   none;
}
.morelink {
    display :   block;
}
/* Set the size of the div element that contains the map */
      #map {
	height :   300px;  /* The height is 400 pixels */
	width :   100%;  /* The width is the width of the web page */
}


</style>
          
          <!-- wrapper -->
          <div id="wrapper" class="detail-page"> 
    <!-- content-->
    <div class="content"> 
              
              <!-- section-->
              <section class="nopadding-top" style="background :   #ffffff">
        <div class="container other-c">
                  <div class="row">
            		<div class="col-sm-5 col-xs-12 text-left">
                              <h1 class="address inline-block"> <span class="adr"> <span class="street-address" title="917 Edison St"><?php echo $property_arr['StreetNumber']." ".$property_arr['StreetName']?> <?php echo ($property_arr["UnitNumber"]!="" && $property_arr['UnitNumber']!='0') ? ' # '.$property_arr['UnitNumber']  :   ''  ?></span> <span class="citystatezip"><span class="locality"><?php echo $property_arr['City']?>, </span> <span class="region"><?php echo $property_arr['StateOrProvince']?></span> <span class="postal-code"><?php echo $property_arr['PostalCode']?></span> </span> </span></h1>
                            </div>
                            <div class="col-sm-3 col-xs-12 ">
                                <h3 style="text-align: right;font-size: 20px;padding: 0;margin: 0;margin-top: 16px"><?= $property_arr['StandardStatus'];?></h3>
                            </div>
                    <div class="col-sm-4 col-xs-12 right">
                              <div class="HomeMainStats home-info inline-block float-right">
                        <div class="info-block price">
                                  <div class="statsValue">
                            <div><span>$</span><span><?php echo number_format($property_arr['ListPrice'])?></span></div>
                          </div>
                                  <span class="statsLabel">Price</span></div>
                                  <?php if($property_arr['BedroomsTotal']!=''){?>
                        <div class="info-block">
                                  <div class="statsValue"><?php echo number_format($property_arr['BedroomsTotal'])?></div>
                                  <span class="statsLabel">Beds</span></div>
                                  <?php }?>
                                   <?php if($property_arr['BathroomsFull']!=''){?>
                        <div class="info-block">
                                  <div class="statsValue"><?= $property_arr['BathroomsFull']?></div>
                                  <span class="statsLabel">Baths</span></div>
                                  <?php }?>
                                  <?php if($property_arr['LivingArea']!=''){?>
    <div class="info-block sqft" ><span><span class="statsValue"><?= $livingarea_str1;?></span> <span class="sqft-label"> sqft</span>
                          <div class="statsLabel">$<?php echo $sqcost?> / sqft</div>
                          </span></div>
                          <?php }?>
                      </div>
                            </div>
              <div class="scroll-nav-wrapper fl-wrap">
                  <div class="container">
                <nav class="scroll-nav scroll-init">
                          <ul>
                    <li><a class="act-scrlink" href="#sec1">About</a></li>
                    <li><a href="#sec2">Location</a></li>
                    <li><a href="#sec3">Open House</a></li>
                    <li><a href="#sec4">Details</a></li>
                    <li><a href="#sec5">Property History</a></li>
                  </ul>
                        </nav>
              </div>
                    </div>
            <div class="col-md-8">
                      <div class="list-single-main-wrapper fl-wrap" id="sec1">
                <div class="list-single-main-media fl-wrap">
                          <div class="single-slider-wrapper fl-wrap">
                    <div class="single-slider fl-wrap">
                              <?php 
						
						$photo_query=mysqli_query($conn,"select * from `mlspin_photos` where `ListingId`='$listid' order by id asc limit 0,15");
						$num_rows=mysqli_num_rows($photo_query);
						$is=0;
						while($resultset=mysqli_fetch_array($photo_query))
						{
							++$is;
						$photo_url=$resultset['image_url'];
						 $new_photo_url=$photo_url;
						
 $pic_name=$listid."_".$is;
$newimg_url= createThumbNailnewww($new_photo_url,'737','491',$localpath,$pic_name);


						?>
                              <div class="slick-slide-item"><img src="<?php echo $baseurl;?>/thumb/<?php echo $newimg_url;?>" alt=""></div>
                              <?php }?>
                            </div>
                    <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                  </div>
                        </div>
                <div class="list-single-main-item fl-wrap">
                          <div class="list-single-main-item-title fl-wrap">
                    <h3>About</h3>
                  </div>
                          <p class="more"><?php echo $property_arr['PublicRemarks'];?></p>
                          <div class="team-holder fl-wrap">
                    <div class="listing-features fl-wrap">
                              <ul class="row">
                                <?php if($property_arr['SubdivisionName']!=''){?>
                        <li class="col-sm-6"> Subdivision <span class="left"><?php echo $property_arr['SubdivisionName'];?></span></li>
                        <?php }?>
                        <?php if($property_arr['ArchitecturalStyle']!=''){?>
                        <li class="col-sm-6">Style <span class="left"><?php echo $property_arr['ArchitecturalStyle']?> </span></li>
                        <?php }?>
                        <li class="col-sm-6">Property Type <span class="left"><?php echo $property_arr['PropertyType'];?></span></li>
                        <li class="col-sm-6">City <span class="left"><?php echo $property_arr['City'];?></span></li>
                        <li class="col-sm-6">County <span class="left"><?php echo $property_arr['CountyOrParish'];?></span></li>
                        <li class="col-sm-6">MLS# <span class="left"><?php echo $listid;?> </span></li>
                          <?php if($property_arr['YearBuilt']!=''){?>
                        <li class="col-sm-6">Built <span class="left"><?php echo $property_arr['YearBuilt'];?></span></li><?php }?>
                        <li class="col-sm-6">Lot Size <span class="left"><?php echo $lotsqrfeet;?>  </span></li> 
                      </ul>
                            </div>
                  </div>
                        </div>
                <div class="list-single-main-item fl-wrap" id="sec2">
                          <div class="list-single-main-item-title fl-wrap">
                    <h3>Location </h3>
                  </div>
                          <div class="team-holder fl-wrap">
                    <div style="width :   100%; height :   100%;" ><a href="https://www.google.com/maps/dir/<?php echo $latitude;?>,<?php echo $longitude;?> /@<?php echo $latitude;?>,<?php echo $longitude;?>" target="_blank" >
                      <div id="map" ></div>
                      </a></div>
                  </div>
                        </div>
                        <?php $openhouserarr=GetupenhouseDetails($conn,$listid);
						
						$idd=$openhouserarr['id'];
						$datentime=$openhouserarr['OpenHouseStartTime'];
						$datearr=explode('T',$datentime);
						$date=changeToStdDate($conn,$datearr[0]);
						$day=date('D',$datearr[0]);
						$time=$datearr[1];
					
						 $starttime=date($datearr[1],strtotime($date));
						
						$timemain=date("g :  i a", strtotime($time));
						 $endminites="+".$openhouserarr['Duration']." minutes";
						 $totalendtime=$endminites/60;

						$endTime = date("g :  i a", strtotime($totalendtime,$time));
						
						$new_time = date("H :  i :  s", strtotime($endminites,$datearr[0]));
						
						 $endmaintime=date("g :  i a", strtotime($new_time));
						
						 $new_time = date("H :  i :  s", strtotime($endminites, strtotime($time))); // $now + 3 hours

						
						$entime=date("g :  i a", strtotime($new_time));

						
						if($idd!=''){
						
						?>
                        
                <div class="list-single-main-item fl-wrap" id="sec3">
                          <div class="list-single-main-item-title fl-wrap">
                    <h3>Open House </h3>
                  </div>
                          <div class="team-holder fl-wrap">
                    <h3><?php echo $day?>, <?php echo $date?> · <?php echo $timemain?> - <?php echo $entime?></h3>
                   <p><?php echo $openhouserarr['OpenHouseRemarks']?></p>                  </div>
                        </div>
                        
                        <?php }?>
               
                        
                        <div id="sec4" class="list-single-main-item fl-wrap"  style="border :   1px solid gainsboro;border-radius :   0px !important;">
                          <div class="list-single-main-item-title fl-wrap">
                    <h3 style="margin-top:0">Interior Features </h3>
                  </div>
                          <div class="flex-list">
                    <?php if($property_arr['MASTER_BATH']=="Yes"){?>
                    <h2 class="heading">Master Bedroom Information</h2>
                    <ul class="detail">
                              <li>Dimensions :   <?php echo $property_arr['MBR_DIMEN'];?></li>
                              <li><?php echo $property_arr['MBR_LEVEL'];?></li>
                            </ul>
                    <?php }?>
                    <?php if($fullBathroom>1)
												{ for($bed=2;$bed<=$fullBathroom;$bed++){
													$bed_dimen=	$property_arr["BED".$bed."_DIMEN"];
												$bed_level=	$property_arr["BED".$bed."_LEVEL"];

													?>
                    <h2 class="heading">Bedroom #<?php echo $bed;?> Information</h2>
                    <ul class="detail">
                              <li>Dimensions :   <?php echo $bed_dimen;?></li>
                              <li>On <?php echo $bed_level;?></li>
                            </ul>
                    <?php } }?>
                    <h2 class="heading">Bathroom  Information</h2>
                    <ul class="detail">
                              <li># of Bathrooms (Full) :   <?php echo $property_arr['BathroomsFull'];?></li>
                              <li># of Bathrooms (1/2) :   <?php echo $property_arr['BathroomsHalf'];?></li>
                              <li> Master Bathroom :   <?php echo $property_arr['MASTER_BATH'];?></li>
                            </ul>
                  </div>
                          <?php  if(!empty($property_arr['EXTERIOR'])){ ?>
                          <div class="list-single-main-item-title fl-wrap">
                    <h3>Exterior Features </h3>
                  </div>
                          <div class="flex-list">
                    <h2 class="heading">Exterior Features</h2>
                    <ul class="detail">
                              <li>Roof :   <?php echo $property_arr['Roof'];?></li>
                              <li>Exterior :  <?php echo $property_arr['EXTERIOR'];?></li>
                              <?php if(!empty($property_arr['ConstructionMaterials'])){?>
                              <li>Construction Material :  <?php echo $property_arr['ConstructionMaterials'];?></li>
                              <?php }?>
                            </ul>
                  </div>
                          <?php }?>
                          <?php  if(!empty($property_arr['ParkingFeatures'])){ ?>
                          <div class="flex-list">
                    <h2 class="heading">Parking Features</h2>
                    <ul class="detail">
                              <li><?php echo $property_arr['ParkingFeatures'];?></li>
                              <li>Garage Parking :  <?php echo $property_arr['GARAGE_PARKING'];?></li>
                              <li>Garage Space :  <?php echo $property_arr['GarageSpaces'];?></li>
                              <li>Open Parking Space :  <?php echo $property_arr['OpenParkingSpace'];?></li>
                            </ul>
                  </div>
                          <?php }?>
                          <div class="list-single-main-item-title fl-wrap">
                    <h3>Utilities </h3>
                  </div>
                          <div class="flex-list">
                    <h2 class="heading">Utilities Information</h2>
                    <ul class="detail">
                              <li>Water Source :  <?php echo $property_arr['WaterSource'];?></li>
                              <li>Sewer and Water :  <?php echo $property_arr['SEWER_AND_WATER'];?></li>
                              <li>Water Front :  <?php echo $property_arr['Water_Front'];?></li>
                              <li>Hot Water :  <?php echo $property_arr['HOT_WATER'];?></li>
                            </ul>
                  </div>
                          <div class="list-single-main-item-title fl-wrap">
                    <h3>Property/Lot Details </h3>
                  </div>
                          <div class="flex-list">
                    <h2 class="heading">Lot Information</h2>
                    <ul class="detail">
                              <li>Living Area (sqft) :   <?php echo $livingarea_str1;?></li>
                              <li>Lot Size in Acres :   <?php echo $property_arr['LotSizeAcres'];?></li>
                            </ul>
                  </div>
                      
                
                  <div class="list-single-main-item-title fl-wrap">
                    <h3>Nearby Similar Homes </h3>
                  </div>
                 <div class="list-main-wrap fl-wrap card-listing nearbylist">
                  <?php
		//	echo "select * from `mlspindata_master` where `City`='$searchedcity' and `ListingId`!='$listid' limit 0,8";
								$selquery=mysqli_query($conn,"select * from `mlspindata_master` where `City`='$searchedcity' and `ListingId`!='$listid' and `PropertyType`!='Rental' order by rand() limit 0,6");
							 $numrows=mysqli_num_rows($selquery);
								if($numrows>0)
								{
									while($resultset=mysqli_fetch_array($selquery))
									{ 
									$prop_id=$resultset['ListingId'];
									$listprice=$resultset['ListPrice'];
									 
									
								$imageurl=getlocationwiseImage($conn,$prop_id);
								 $pic_name=$prop_id."_".$is;
$newimg_urls= createThumbNailnewww($imageurl,'254','158',$localpath,$pic_name);
   							$city=$resultset['City'];
							 
 if($resultset['LivingArea']!='' && $resultset['LivingArea']!='0')
 {
	 

	$fisrt_str=number_format(intval($resultset['LivingArea'])); 
	 
	  if($fisrt_str==0)
	  
 {
	$fisrt_str=" —"; 
	 
 }
 }
 else
 {
	$fisrt_str=" —"; 
	 
 }
								

									if($city!='')
							{
								
							$city=$resultset['City'];	
							}
							//$address=$resultset['StreetName']." ".$city.$resultset['CountyOrParish'];
							 if($resultset['PostalCode']!="")
				   {
					 $zipcode=" ".$resultset['PostalCode'];  
					   
				   }
							$address=$city.", ".$resultset['StateOrProvince'].$zipcode;	
								?>
                	<div class="col-sm-4">
                   
                    <div class="listing-item">
                <article class="geodir-category-listing fl-wrap"> <a href="<?php echo $baseurl;?>/property/<?php echo $prop_id;?>">
               <div class="geodir-category-img"> <img src="<?php echo $baseurl;?>/thumb/<?php echo $newimg_urls;?>" alt="">
                    <div class="overlay"></div>
                  </div>
                  </a>
                          <div class="geodir-category-content fl-wrap">
                    <h3>$<?php echo number_format($listprice);?></h3>
                    <ul class="listInline" style="min-height :   22px;">
									                    <li><i class="fa fa-bed"></i> <?= ($resultset['BedroomsTotal'] != "" && $resultset['BedroomsTotal'] != "0") ? $resultset['BedroomsTotal'].' bd' : ' — bd';?></li>
									                    <li><i class="fa fa-bath"></i> <?= ($resultset['BathroomsFull'] !="" && $resultset['BathroomsFull'] !="0") ? $resultset['BathroomsFull'].' ba' : ' — ba';?></li>
									                    <li><?= $fisrt_str;?> sqft</li>
                                                     </ul>
                  <p><?php echo $resultset['StreetNumber'];?> <?php echo $resultset['StreetName']?> <?php echo ($resultset["UnitNumber"]!="" && $resultset['UnitNumber']!='0') ? ' # '.$resultset['UnitNumber'] : ''  ?></p>
                  <p><?php echo $address;?></p>
                  </div>
                        </article>
              </div>
                    </div>
                    
                 <?php } }?>
                    </div>
                </div>
                
                
              </div>
                    </div>
            <!--box-widget-wrap -->
          <div class="col-md-4">
            <form method="post" action="<?php echo $baseurl;?>/book/<?php echo $listid;?>">
                <div class="box-widget-wrap fixed-bar fl-wrap">
                          <h3 class="tour">Go Tour This Home</h3>
                          <div id="carousel" class="owl-carousel">
                    <?php   
                                $alldates=getalldatesofmonth($pdate,$pyear);
								$dateserial=0;
								foreach($alldates as $dates)
								{
									
									$exploded_string=explode("-",$dates);
									$year=$exploded_string[0];
								$month=$exploded_string[1];
									$mydate=$exploded_string[2];

									  $monthnew=getmonth($conn,$month);
$pdate=date("Y-m-d");
if($pdate<=$dates)
{
	
	$dateserial++;
	if($dateserial==1)
	{
		$date_class="selected-item";
		$first_date=$dates;
		
	}
	else
	{
	$date_class="";	
		
		
		
	}
	
								?>
                    <div class="item" >
                              <div class="ldpGrayDayOptionContainer <?php echo $date_class;?>" onClick="setDates('<?php echo $dates;?>')">
                        <div class="dayOfTheWeek"><?php echo date('D', strtotime($dates));?></div>
                        <div class="dayOfTheMonth"><?php echo $mydate;?></div>
                        <div class="month"><?php echo $monthnew;?></div>
                      </div>
                            </div>
                    <?php  } }?>
                  </div>
                          <input type="hidden" id="hiddendate" name="hiddendate" value="<?php echo $first_date;?>">
                          <button type="submit" class="btn  big-btn  color-bg flat-btn book-btn">Schedule Tour<i class="fa fa-angle-right"></i></button>
                          <span class="free">It's free, with no obligation — cancel anytime</span>
                          <div class="contactlink">
                    <ul class="ask">
                              <li><a href="#">Ask Question</a></li>
                            </ul>
                    <ul class="number">
                              <li><a href="tel :  +1-617-663-8864" class="phone-number TextOrCallPhoneLink">1-617-663-8864</a></li>
                            </ul>
                  </div>
                        </div>
             </form>
           </div>
                    
            <!--box-widget-wrap end --> 
          </div>
                </div>
      </section>
              <!-- section end-->
              
                   <?php
				   
								$selquerys=mysqli_query($conn,"select * from `mlspindata_master` where `City`='$searchedcity' and `ListingId`!='$listid' limit 0,8");
						$numrows=mysqli_num_rows($selquerys);
							if($numrows>0)
							{?>
              <section class="gray-section" style="display :  none">
        <div class="container">
                  <div class="section-title">
            <h2>Nearby Similar Homes</h2>
            <div class="section-subtitle">Best Selling</div>
            <span class="section-separator"></span> </div>
                </div>
        <!-- carousel -->
        <div class="list-carousel fl-wrap card-listing "> 
                  <!--listing-carousel-->
                  <div class="listing-carousel  fl-wrap "> 
            <!--slick-slide-item-->
            <?php
								$selquery=mysqli_query($conn,"select `id`,`ListPrice`,`city`,`StreetName`,`CountyOrParish`,`PublicRemarks` from `mlspindata_master` where `City`='$searchedcity' and `ListingId`!='$listid' limit 0,8");
							 $numrows=mysqli_num_rows($selquery);
								if($numrows>0)
								{
									while($resultset=mysqli_fetch_array($selquery))
									{ 
									$prop_id=$resultset['id'];
									$listprice=$resultset['ListPrice'];
									if($city!='')
							{
								
							$city=",".$resultset['city'];	
							}
							$address=$resultset['StreetName']." ".$city.$resultset['CountyOrParish'];
								?>
            <div class="slick-slide-item"> 
                      <!-- listing-item -->
                      <div class="listing-item">
                <article class="geodir-category-listing fl-wrap"> <a href="<?php echo $baseurl;?>/property/<?php echo $prop_id;?>">
                  <div class="geodir-category-img"> <img src="<?php echo $baseurl;?>/images/all/item_1.jpg" alt="">
                    <div class="overlay"></div>
                  </div>
                  </a>
                          <div class="geodir-category-content fl-wrap">
                    <h3>$<?php echo $listprice;?></h3>
                    <p><?php echo limitContent($conn,$resultset['PublicRemarks'],50);?></p>
                    <div class="geodir-category-options fl-wrap">
                              <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address;?></a></div>
                            </div>
                  </div>
                        </article>
              </div>
                      <!-- listing-item end--> 
                    </div>
            <?php } }?>
            
            <!--slick-slide-item end--> 
          </div>
                  <!--listing-carousel end-->
                  <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                  <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                </div>
        <!--  carousel end--> 
      </section>
      <?php }?>
              <div class="limit-box fl-wrap"></div>
              <div class="limit-box fl-wrap"></div>
              <!-- section --> 
              
              <!-- section end--> 
            </div>
    <!-- content end--> 
  </div>
          <!-- wrapper end --> 
          <!--footer --> 
                    <script type="text/javascript" src="<?php echo $baseurl;?>/javascript/api.js"></script>

          <?php include_once("footer.php");?>
<!--Google Maps start=====================--> 
<script src="<?php echo $baseurl?>/js/modernizr.js"></script> 
<script>
                            var map,
                            desktopScreen = Modernizr.mq( "only screen and (max-width :  1024px)" ),
                            zoom = desktopScreen ? 11  :   11,
                            scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
                            isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[:]11/));
                            function initMap() 
                            {
                      
                
                                        var myLatLng = {lat:<?= $latitude;?>, lng:<?= $longitude;?>};
                                        map = new google.maps.Map(document.getElementById('map'), {
                                            zoom:zoom,
                                            center:myLatLng,
                                            mapTypeId:google.maps.MapTypeId.TERRAIN,
                                            scrollwheel:scrollable,
                                            draggable: draggable,
                                              disableDefaultUI: true,
                                            styles:[{"stylers":[{ "saturation":10}]}]
                                        });
                                        
                                        
                                        /*marker array*/
                                      var locations = [
                                                
                                                 {
                                                    title :   '',
                                                    position :   {lat :  <?= $latitude;?>, lng :  <?= $longitude;?>},
                                                    icon :   {url :   isIE11 ? "<?php echo $baseurl;?>/images/dot.png"  :   "<?php echo $baseurl;?>/images/dot.png",scaledSize :   new google.maps.Size(15, 15),
                                                    
                                                    },
                                                    contentString :  '<p class="address inline-block"> <span class="adr"> <span class="street-address"><?php echo $property_arr['StreetNumber']." ".$property_arr['StreetName']?> </span> <span class="citystatezip"><span class="locality"><?php echo $property_arr['City']?>, </span> <span class="region"><?php echo $property_arr['StateOrProvince']?></span> <span class="postal-code"><?php echo $property_arr['PostalCode']?></span> </span> </span></p>'
                            
                                                },
                                             
                                        ];
                                        
                                        /*end marker array*/
                                        
                                        /*start loop location marker*/
                                        
                                locations.forEach( function( element, index ){  
                                var marker = new google.maps.Marker({
                                    position :   element.position,
                                    map :   map,
                                    title :   element.title,
                                    icon :   element.icon,
                                    url :    element.url,
                                    
                                });
                                var infowindow = new google.maps.InfoWindow({
                                  content :   element.contentString
                                });
                                
                                if (screen.width > 800){
                                    marker.addListener('mouseover', function() {
                                      infowindow.open(map, marker);
                                      
                                    });
                                    marker.addListener('mouseout', function() {
                                      infowindow.close(map, marker);
                                    });
                                }
                                
                                if (screen.width < 800){
            
                                marker.addListener('click', function() {
                                      infowindow.open(map, marker);
                                                
                                         
                                                
                                    });
                                     
                                    
                                    }
                                
                            }); 
                            }/*end initmap*/
							
							$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 200;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Continue reading";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
							
                </script> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1V5snT00sU2-Ix88PcJosqxvkXjSTq9w&callback=initMap&libraries=places" async="" defer=""></script> 
<!--Google Maps end=======================--> 
