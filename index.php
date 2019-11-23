<?php
ob_start();
session_start();
include_once("configuration/connect.php");
include_once("configuration/functions.php");


if(isset($_POST['property_search']))
{
	
extract($_POST);

 $prop_type=strtolower($prop_type);

//$searchtype=strtolower(strreplace($conn,$searchtype));
$searchtype=strtolower(strreplace($conn,$hidsearchtype_val));


//hidsearchtype
//hidsearchtype_val
//$urls="property/$prop_type/$searchtype/$hidsearchtype/1";
$urls="property/$prop_type/$searchtype/$hidsearchtype/1";
header("location:$urls");
exit;
}


?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<!--=============== basic  ===============-->
<meta charset="UTF-8">
<title><?php echo $pagename;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="robots" content="index, follow"/>
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<!--=============== css  ===============-->

<style>
#loader {
	position: absolute;
	top: 30%;
	right: 16px;
}
.ff {
        background-color: #fff;
    box-shadow: 0 0 15px 0 #f2ecec;
    padding: 50px 0px;
    margin-top: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.ff>h2 {
    font-size: 22px;
    font-weight: 400;
    margin-bottom: 1rem;
}
	.ff>h2 strong {
    display: block;
    margin: 2rem 0;
    font-weight: 600;
    font-size: 36px;
}
.ff>p {
    text-align: center;
    font-size: 17px;
    color: #353535;
    font-weight: 400;
    padding: 10px;
}
.margin {
    width: 33.33333333% ;
    background: transparent !important;
    box-shadow: none !IMPORTANT;
    margin-bottom: 0 !important;
    padding: 0px !important;
    margin-right: 0px !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
}

.widee .nice-select-search-box {
    display: none;
}

.widee .list {
    padding: 10px 12px 10px!important;
}

</style>
<!--  header end -->

<?php include_once("header.php");?>
<!--  wrapper  -->

  <!-- Content-->
  <div class="content"> 
    <!--section -->
    <section class="scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1"> 
      <!-- <div class="bg" data-bg="<?php echo $baseurl;?>/photos/<?php echo $home_image;?>" data-scrollax="properties: { translateY: '200px' }"></div>-->
      <div class="bg" data-bg="images/banner-boshall.jpg" data-scrollax="properties: { translateY: '200px' }" style="background-color: #0078c5;"></div>
      <div class="overlay"></div>
      <div class="hero-section-wrap fl-wrap">
        <div class="container">
          <div class="col-sm-1"></div>
          <div class="col-sm-8">
            <div class="intro-item fl-wrap"> 
              <!-- <h2>We will help you to find all</h2>-->
              <h3>Buy a home, &nbsp;&nbsp; Sell your home, &nbsp;&nbsp;Get Free Home Estimate.</h3>
            </div>
            <form method="post" id="mainsearch_forms" name="mainsearch_forms">
              <div class="main-search-input-wrap">
                <div class="main-search-input fl-wrap">
                  <div class="main-search-input-item">
                    <select data-placeholder="All Categories" class="chosen-select widee" name="prop_type" >
                      <?php 
												
												$query=mysqli_query($conn,"SELECT * FROM `propertyfor` WHERE `status`='1' ORDER BY `id` DESC");
												$numrowss=mysqli_num_rows($query);
												if($numrowss>0)
												{
											while($resultsets=mysqli_fetch_array($query))
											{	$prop_id=$resultsets['id'];

												$slugs=$resultsets['slug'];
												?>
                      <option value="<?php echo $slugs;?>" <?php if($prop_id==3){?> selected<?php }?>><?php echo $resultsets['name'];?></option>
                      <?php } }?>
                    </select>
                  </div>
                  <div class="main-search-input-item">
                    <input type="text" placeholder="City, Address, ZIP" value="" id="mainsearchbar" autocomplete="off" class="mainsearchbar" name="searchtype"/>
                    <span id="loader" style="display:none;"><img src="<?php echo $baseurl;?>/images/load.gif" style="width:20px"></span> </div>
                  <input type="hidden" name="hidsearchtype" id="hidsearchtype" value="">
                  <input type="hidden" name="hidsearchtype_val" id="hidsearchtype_val" value="">
                  <input type="submit" class="main-search-button" style="line-height:50px" name="property_search" value="Search">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- section end -->
    
    <div class="city-section">
      <div class=" container-fluid">
        <div class="">
          <h2 class="heading-h">Hot Market </h2>
        </div>
        <div class="row">
          <div class="list-carousel fl-wrap card-listing "> 
            <!--listing-carousel-->
            <div class="city-carousel  fl-wrap "> 
              <!--slick-slide-item-->
              
              <?php 
			  
	//	$arr=array('Cambridge', 'Brookline', 'Newton', 'Lexington', 'Belmont', 'Westwood', 'Welleslley', 'Winchester', 'Waltham');
		
		
		 $cquery=mysqli_query($conn,"select  distinct `City` from `mlspindata_master` where `City` like '%Brookline%' or `City` like '%Belmont%' or `City` like '%Cambridge%' or `City` like '%Lexington%' or `City` like '%Newton%' or `City` like '%Westwood%' or `City` like '%Welleslley%' or `City` like '%Winchester%' or `City` like '%Waltham%' and `view`='1' and `hometype`='1' order by `City` ASC limit 0,9"); 
			// $cquery=mysqli_query($conn,"select distinct `city` from `mlspindata_master` where `view`='1' and `hometype`='1' order by rand() limit 0,6");
			 	
 $numrows=mysqli_num_rows($cquery);
	   if($numrows>0)
	   {  
	   
	   while($resultset=mysqli_fetch_array($cquery))
	   {
		   
	 $city=$resultset['City'];
		  $propdetails=getPropertybycity($conn,$city);
		   		   $price=$propdetails['ListPrice']; 
				$listid=getListingIdBymaxPropertyAndCity($conn,$city);

$address=$propdetails['StreetName']." ".$city.$propdetails['CountyOrParish'];
$cityname=strtolower(strreplace($conn,$city));
$type=1;

$imageurl=getlocationwiseImage($conn,$listid);

$housecount=homecountfromcityname($conn,$city);


$minimumcost=getminhomepricebycityWithType($conn,$city,"Rental");


$maximumcost=getmaxhomepricebycityWithType($conn,$city,"Rental");




$searchtype=strtolower(strreplace($conn,$city));

$cityurl="property/buy/$searchtype/1";

	   ?> 
              
              <div class="slick-slide-item"> 
                <!-- listing-item -->
                <div class="listing-item city-item">
                  <div class="city-list">
                
                    <div class="col-sm-5 padd-0">
                      <div class="image-city"> <img src="<?php echo $imageurl;?>" style="width:100%"> </div>
                    </div>
                    <div class="col-sm-7 padd-0">
                      <div class="detail-city">
                        <ul class="css-1r1r9ky mlm mvn">
                          <li>
                            <h4 class="heading-city"><?php echo  ucfirst($city);?></h4>
                          </li>
                          <li class="mediaInline mvs"><img src="<?php echo $baseurl;?>/images/icon_sign_for_sale.svg" alt=""><span class="pls"><?= $housecount?> Homes For Sale</span></li>
                          <li class="mediaInline mvs "><img src="<?php echo $baseurl;?>/images/icon_home_for_sale.svg" alt="" >
                          <span class="pls">Buy: $<?php echo nice_number($minimumcost); ?> - $<?php echo nice_number($maximumcost) ;?></span></li>
                         <a href="<?php echo $baseurl?>/<?php echo $cityurl?>"> <li class="typeHighlight clickable">See Local Highlights</li></a>
                        </ul>
                      </div>
                    </div>
                
                  </div>
                </div>
                <!-- listing-item end--> 
              </div>
          <?php }}?>
              </div>
            <!--listing-carousel end-->
            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
          </div>
        </div>
      </div>
    </div>
    
    <!--section -->
    <section class="home-section">
      <div class="container-fluid">
        <h2 class="heading-h">High End Listing </h2>
      </div>
      <!-- carousel -->
      <div class="list-carousel fl-wrap card-listing "> 
        <!--listing-carousel-->
        <div class="listing-carousel  fl-wrap "> 
          <!--slick-slide-item-->
          
          <?php
        $cquery1=mysqli_query($conn,"SELECT * FROM `mlspindata_master` WHERE `hometype`='1' AND `PropertyType`!='Rental' ORDER BY  `ListPrice` DESC limit 0,6");						  
        $numrows1=mysqli_num_rows($cquery1);
            if($numrows1>0)
            {  

            while($resultset=mysqli_fetch_array($cquery1))
            {
              $listid=$resultset['ListingId'];
              $imageurl=getlocationwiseImage($conn,$listid);
              $city=$resultset['City'];
             

              $address=$city.", ".$resultset['StateOrProvince']." ".$resultset['PostalCode'];				
              
                  $sqrt1=intval($resultset['LivingArea']);

							
							
	   ?>
          <div class="slick-slide-item"> 
            <!-- listing-item -->
            <div class="listing-item">
              <article class="geodir-category-listing fl-wrap"> <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">
                <div class="geodir-category-img"> <img src="<?php echo $imageurl;?>" alt="">
                  <div class="overlay"></div>
                </div>
                </a>
                <div class="backgroundBasic">
                  <div class="h5">$<?php echo number_format($resultset['ListPrice']);?></div>
                  <ul class="listInline" style="min-height: 22px;">
                    <li><i class="fa fa-bed"></i> <?php echo ($resultset['BedroomsTotal']!="" && $resultset['BedroomsTotal']!="0") ? $resultset['BedroomsTotal'].' bd' : ' — bd'?></li>
                    <li><i class="fa fa-bath"></i> <?php echo ($resultset['BathroomsFull']!="" && $resultset['BathroomsFull']!="0") ? $resultset['BathroomsFull'].' ba' : ' — ba'?></li>
                    <li><?php echo ($sqrt1!="") ? number_format($sqrt1).' sqft'  : ' — sqft' ?></li>
                  </ul>
                  <div class="typeLowlight"><?php echo $resultset['StreetNumber'];?> <?php echo $resultset['StreetName'];?> <?php echo ($resultset["UnitNumber"]!="" && $resultset['UnitNumber']!='0') ? ' # '.$resultset['UnitNumber'] : ''  ?></div>
                  <div class="typeLowlight"> <?php echo $address;?></div>
                </div>
                
              </article>
            </div>
            <!-- listing-item end--> 
          </div>
          <?php }}?>
        </div>
        <!--listing-carousel end-->
        <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
      </div>
      <!--  carousel end--> 
    </section>
    <!-- section end --> 
    
    <!--section -->
    <section class="home-section" style="    padding-bottom: 20px;">
      <div class="container-fluid">
        <h2 class="heading-h">New Listing </h2>
      </div>
      <!-- carousel -->
      <div class="list-carousel fl-wrap card-listing "> 
        <!--listing-carousel-->
        <div class="listing-carousel  fl-wrap "> 
          <!--slick-slide-item-->
          
          <?php
		  
		  $current_date=date("y-m-d");
 $days_ago = date('Y-m-d', strtotime('-3 days', strtotime($current_date)));
				$cquery=mysqli_query($conn,"SELECT DISTINCT `City` FROM`mlspindata_master` WHERE `view`='1' and `list_date` BETWEEN '$days_ago' AND CURRENT_DATE() and `PropertyType`!='Rental' limit 0,12");
										  
 $numrows=mysqli_num_rows($cquery);
	   if($numrows>0)
	   {  
	   
	   while($resultset=mysqli_fetch_array($cquery))
	   {
		   							

		  $city=$resultset['City'];
		  $propdetails=getPropertybycity($conn,$city);
		//  print_r($propdetails);
		   		   $price=$propdetails['ListPrice'];
				   $listid=$propdetails['ListingId'];

		   							$imageurl=getlocationwiseImage($conn,$listid);
				   $zipcode=""; 
				   if($propdetails['PostalCode']!="")
				   {
					 $zipcode=" ".$propdetails['PostalCode'];  
					   
				   }
							$address=$city.", ".$propdetails['StateOrProvince'].$zipcode;
							if($propdetails['LivingArea']!='' && $propdetails['LivingArea']!='0')
							{


								$sqrt=number_format(intval($propdetails['LivingArea']));

							}
							 else
							 {
								 $sqrt=" —";
								 
							 }

	   ?>
          <div class="slick-slide-item"> 
            <!-- listing-item -->
            <div class="listing-item">
              <article class="geodir-category-listing fl-wrap"> <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">
                <div class="geodir-category-img"> <img src="<?php echo $imageurl;?>" alt="">
                  <div class="overlay"></div>
                </div>
                </a>
                <div class="backgroundBasic">
                  <div class="h5">$<?php echo number_format($price);?></div>
                  <ul class="listInline" style="min-height: 22px;">

                    <li><i class="fa fa-bed"></i> <?php echo ($propdetails['BedroomsTotal']!="" && $propdetails['BedroomsTotal']!=0) ? $propdetails['BedroomsTotal'].' bd' : ' — bd' ?> </li>
                    <li><i class="fa fa-bath"></i> <?php echo ($propdetails['BathroomsFull']!="" && $propdetails['BathroomsFull']!=0) ? $propdetails['BathroomsFull'].' ba' : ' — ba' ?> </li>
                    <li><?php echo $sqrt;?> sqft</li>
                  </ul>
                  <div class="typeLowlight"> <?php echo $propdetails['StreetNumber'];?> <?php echo $propdetails['StreetName']?> <?php echo ($propdetails["UnitNumber"]!="" && $propdetails['UnitNumber']!='0') ? ' # '.$propdetails['UnitNumber'] : ''  ?></div>
                  <div class="typeLowlight"> <?php echo $address;?></div>
                </div>
                
              </article>
            </div>
            <!-- listing-item end--> 
          </div>
          <?php }}?>
        </div>
        <!--listing-carousel end-->
        <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
        <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
      </div>
      <!--  carousel end--> 
    </section>
    <!-- section end --> 
    
 
    
    <section class="gray-section">
      <div class="container">
      
          <div class="row">
            <div class="col-sm-6">
             <img src="img/video-b.jpg" class="img-responsive">
            </div>
            <div class="col-sm-6">
              <div class="video-detail">
                <h6>SELLING</h6>
                <h2>Sell for more than <br>
                  the home next door</h2>
                <p>Request a free, no-obligation consultation. <br>
                 </p>
                  <form id="enquiryform" name="enquiryform" method="post">
                <div class="row">
                  <div class="form">
                    <div class="col-sm-8">
                      <input class="enteremail"  placeholder="Enter your email Address" type="text" name="enquiryemail" id="enquiryemail" autocomplete="user-password">
                    </div>
                    <div class="col-sm-4">
                      <button type="submit" id="subscribe-button" class="subscribe-button">Submit</button>

                     

                    </div>
                  </div>
                </div>
                </form>
                
              
              </div>
            </div>
          </div>
          <div class="row">
            <div class="first-up margin col-12 col-lg-4 col-md-4 col-sm-4 col-xs-12">
             <div class="ff">
              <h2 class="font-weight-bold">Pay as low as a<strong> 1% </strong>listing fee</h2>
              <p>With a Redfin Agent, you get full service and save thousands in fees.</p>
            </div>
			  </div>
			
            <div class="second-up margin col-12 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="ff">
              <h2 class="font-weight-bold">Reach<strong> 3x </strong>more buyers</h2>
              <p>We get more eyes on your listing as America's #1 brokerage website.</p>
            </div>
		  </div>
            <div class="third-upmargin col-12 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="ff">
              <h2 class="font-weight-bold">More<strong> $$$ </strong>in your pocket</h2>
              <p>We sell for $2,800 more on average compared to other brokerages.</p>
            </div>
		  </div>
		  </div>
      </div>
    </section>
    
    
    <div class="buy-and-gift">
    	<div class="container">
        <div class="row">
        	<div class="box-white">
            	<div class="col-sm-7">
               <div class="buy-inner1">
                <h6>SELLING</h6>
                <h2>Find homes first, tour homes fast</h2>
                <p>Get an edge over other buyers with our online tools and a local Redfin Agent.</p>
                
                    <ul class="list-buy">
                        <li><svg class="SvgIcon rfSvg star"><svg viewBox="0 0 22 21"><path d="M7.518 6.778L.2 7.844a.235.235 0 0 0-.13.4l5.294 5.175-1.25 7.305a.235.235 0 0 0 .341.249L11 17.523l6.544 3.45a.235.235 0 0 0 .34-.249l-1.25-7.305 5.294-5.174a.235.235 0 0 0-.13-.401l-7.316-1.066L11.21.13a.234.234 0 0 0-.42 0z" fill-rule="evenodd"></path></svg></svg> <strong>Find homes first—</strong>you see the latest listings every 5 minutes and get new home updates 3 hours faster.</li>
                        <li><svg class="SvgIcon rfSvg lightning-bolt"><svg viewBox="0 0 19 32"><path d="M15.493.127L.086 18.27a.357.357 0 0 0 .269.589h6.313l-3.77 12.679c-.11.37.36.629.608.334l15.408-18.141a.358.358 0 0 0-.27-.59h-6.31L16.1.462c.11-.37-.358-.63-.608-.336z" fill-rule="evenodd"></path></svg></svg> <strong> Tour faster—</strong>book online and tour homes ASAP, even same day.</li>
                        <li><svg class="SvgIcon rfSvg price"><svg viewBox="0 0 24 24"><path d="M12 11c-1.654 0-3-1.306-3-3s1.346-3 3-3a2.975 2.975 0 0 1 2.991 2.764c.01.132.111.236.243.236h1.503a.256.256 0 0 0 .256-.264A4.973 4.973 0 0 0 13 3.099V1.25a.25.25 0 0 0-.25-.25h-1.5a.25.25 0 0 0-.25.25v1.849A4.976 4.976 0 0 0 7 8c0 2.797 2.243 5 5 5 1.654 0 3 1.306 3 3s-1.346 3-3 3a2.975 2.975 0 0 1-2.991-2.764.247.247 0 0 0-.243-.236H7.263a.256.256 0 0 0-.256.264A4.971 4.971 0 0 0 11 20.9v1.85c0 .138.112.25.25.25h1.5a.25.25 0 0 0 .25-.25V20.9c2.279-.457 4-2.45 4-4.9 0-2.797-2.243-5-5-5" fill-rule="evenodd"></path></svg></svg><strong> Save $8,400 on average—</strong>you save thousands and get full service when you buy and sell with Redfin.</li>
                </ul>
                </div>
                
                </div>
                 
                <div class="col-sm-5">
                
                
                </div>
            </div>
        </div>
        </div>
    </div>
    
    
    <section class="how-to-use gray-section">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-sm-4 col-xs-12">
               	<div class="ff">
                	<div class="images">
                    	<img src="images/Buy_a_home.png" style="width:100%">
                    </div>
                    
                    <div class="content-how">
                    <h2>Buy A Home</h2>
                    <p>Find your place with an immersive photo experience and the most listings, including things you won't find anywhere else.</p>
                    
                    <a href="#" class="btn-how">Search homes</a>
                    </div>
					</div>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="ff">
                	<div class="images">
                    	<img src="images/Sell_a_home.png" style="width:100%">
                    </div>
                    
                    <div class="content-how">
                    <h2>Sell A Home</h2>
                    <p>Whether you sell with new Zillow Offers™ or take another approach, we'll help you navigate the path to a successful sale.</p>
                    
                    <a href="#" class="btn-how">See Your Option</a>
                    </div>
                </div>
				</div>
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="ff">
                	<div class="images">
                    	<img src="images/Rent_a_home.png" style="width:100%">
                    </div>
                    
                    <div class="content-how">
                    <h2>Rent A Home</h2>
                    <p>We're creating a seamless online experience – from shopping on the largest rental network, to applying, to paying rent.</p>
                    
                    <a href="#" class="btn-how">Find Rentals</a>
                    </div>
					</div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="list-city">
    	<div class="container">
        <h2 class="heading-h">
        Search for Homes by City
        </h2>
        	<div class="col-sm-12">

            	<ul class="city-list">
<?php 
  $cquery=mysqli_query($conn,"select distinct `city` from `mlspindata_master` where `view`='1' order by `City` limit 0,80");						  
 $numrows=mysqli_num_rows($cquery);
	   if($numrows>0)
	   {  
	   
	   while($resultset=mysqli_fetch_array($cquery))
	   {
		   
	 $city=$resultset['city'];
	$cty=strtolower(strreplace($conn,$city));	

$cityurl="property/buy/$cty/1";

	   ?> 
        

  <li class="city"><a href="<?php echo $baseurl."/".$cityurl?>" title="<?php echo  ucfirst($city);?>"><?php echo  ucfirst($city);?></a></li>
<?php }}?>

</ul>
            </div>
        </div>
    
    </div>
  </div>
  <!-- Content end --> 
</div>
<!-- wrapper end --> 
<!--footer -->



<?php include_once("footer.php");?>
<script>
 $('#mainsearchbar').keyup(function(e){
	 
	 
	 
	 if((e.keyCode == 8) || (e.keyCode ==32))
	 {

document.getElementById('hidsearchtype').value='';     


	 }
	 
	 }) 
function delete_val()
{
	alert("in");
//$('#hidsearchtype').val();     

//document.getElementById('hidsearchtype').value='';
	
}
$( "#mainsearchbar" ).autocomplete({
	
   source: function (request, response) {
    $.ajax({
		
    url: "mainsearch.php",
      type: "GET",
      data: request,
        dataType: 'json',
		  beforeSend: function(){
		$("#loader").css("display", "block");
	 
     //$("#loader").show();

   },
  /* search: function (e, u) { alert();
                    $(this).addClass('loader');
                },*/
              
       success: function (data) {
$("#loader").hide();	 
  //   $("#mainsearchbar").val('');

        /*alert(data[0].type+"-"+data[0].value);*/
        $('#hidsearchtype_val').val(data[0].value);
        $('#hidsearchtype').val(data[0].type);  
       response($.map(data, function (el) {
		                  //     $(this).removeClass('loader');

          return {
          label: el.label, 
          value: el.value,
    		  id: el.id,
    		  type: el.type
            };
           }));
          }
        });
  },
select:function (e, ui) {
	$('#mainsearchbar').val(ui.item.value);

$('#hidsearchtype_val').val(ui.item.value);
$('#hidsearchtype').val(ui.item.type);     
//eventtype_idval=document.getElementById('eventtype_id').value;

//if(eventtype_idval=='2')
//{
//}





}
});


 
  //$("#owl-example").owlCarousel();
 

</script>

<div class="modal" tabindex="-1" role="dialog" id="enquirypopup" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p><img src="<?php echo $baseurl?>/images/check.png" style="width: 53px;margin-top: 13px;">
      </p>
        <p><strong>Thank you!</strong></p>
        <p>Request has been submitted. Our team wil contact you soon.</p>
      </div>
      
    </div>
  </div>
</div>