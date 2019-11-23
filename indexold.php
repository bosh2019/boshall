<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
$home_image=gethomebannerSingleImage($conn);




if(isset($_POST['property_search']))
{
	
extract($_POST);

 $prop_type=strtolower($prop_type);

$searchtype=strtolower(strreplace($conn,$searchtype));



$urls="property/$prop_type/$searchtype/$hidsearchtype";

header("location:$urls");
	
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
  </style>
            <!--  header end -->
            
            <?php include_once("header.php");?>
            <!--  wrapper  -->
            <div id="wrapper">
                <!-- Content-->
                <div class="content">
                    <!--section -->
                    <section class="scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1">
                        <div class="bg"  data-bg="<?php echo $baseurl;?>/photos/<?php echo $home_image;?>" data-scrollax="properties: { translateY: '200px' }"></div>
                        <div class="overlay"></div>
                        <div class="hero-section-wrap fl-wrap">
                            <div class="container">
                                <div class="intro-item fl-wrap">
                                    <h2>We will help you to find all</h2>
                                    <h3>Find great places , Find a Home , Sell My Home , See Home Estimate.</h3>
                                </div>
                                
                                <form method="post" id="mainsearch_forms" name="mainsearch_forms">
                                <div class="main-search-input-wrap">
                                    <div class="main-search-input fl-wrap">
                                        
                                      
                                        <div class="main-search-input-item">
                                            <select data-placeholder="All Categories" class="chosen-select" name="prop_type" >
                                            <option value="">Select Category</option>
                                                <?php 
												
												$query=mysqli_query($conn,"select * from `propertyfor` where `status`='1'");
												$numrowss=mysqli_num_rows($query);
												if($numrowss>0)
												{
											while($resultsets=mysqli_fetch_array($query))
											{	
												$slugs=$resultsets['slug'];
												?>
                                                <option value="<?php echo $slugs;?>"><?php echo $resultsets['name'];?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                        <div class="main-search-input-item">
                                        	
                                            <input type="text" placeholder="City, Address, ZIP" value="" id="mainsearchbar" autocomplete="off" class="mainsearchbar" name="searchtype"/>  
<span id="loader" style="display:none;"><img src="<?php echo $baseurl;?>/images/load.gif" style="width:20px"></span>                                        </div>
                                     <input type="hidden" name="hidsearchtype" id="hidsearchtype" value="">   <input type="submit" class="main-search-button" style="line-height:50px" name="property_search" value="Search">
                                    </div>
                                </div>
                                
                                </form>
                            </div>
                        </div>
                        
                    </section>
                    <!-- section end -->
                    <!--section -->
                    <section id="sec2">
                        <div class="container">
                            <div class="section-title">
                                <h2>Featured Location</h2>
                                <div class="section-subtitle"> Categories</div>
                                <span class="section-separator"></span>
                                <p>Explore some of the best tips from around the city from our partners and friends.</p>
                            </div>
                            <!-- portfolio start -->
                            <div class="gallery-items fl-wrap mr-bot spad">
                                  <?php
				$cquery=mysqli_query($conn,"select distinct `city` from `mlspindata_master` where `view`='1' order by rand() limit 0,6");						  
 $numrows=mysqli_num_rows($cquery);
	   if($numrows>0)
	   {  
	   
	   while($resultset=mysqli_fetch_array($cquery))
	   {
		   
	 $city=$resultset['city'];
		  $propdetails=getPropertybycity($conn,$city);
		   		   $price=$propdetails['ListPrice']; 
				  $listid=$propdetails['ListingId'];

							$address=$propdetails['StreetName']." ".$city.$propdetails['CountyOrParish'];
$cityname=strtolower(strreplace($conn,$city));
$type=1;

$imageurl=getlocationwiseImage($conn,$listid)
	   ?> 
                                <div class="gallery-item">
                                    <a href="<?php echo $baseurl;?>/property/buy/<?php echo $cityname;?>/<?php echo $type;?>"><div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                            <img  src="<?php echo $imageurl;?>"   alt="">
                                           
                                            <div class="listing-item-cat">
                                                <h3><?php echo  ucfirst($city);?></h3>
                                            </div>
                                        </div>
                                    </div></a>
                                </div>
                             <?php }}?> 
                            </div>
                         </div>
                  </section>
                    <!-- section end -->
                    <!--section -->
                    <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Popular listings</h2>
                                <div class="section-subtitle">Best Listings</div> 
                                <span class="section-separator"></span>
                            </div>
                        </div>
                        <!-- carousel -->
                        <div class="list-carousel fl-wrap card-listing ">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">
                                <!--slick-slide-item-->
                                
       <?php
				$cquery=mysqli_query($conn,"select * from `mlspindata_master` where `view`='1' order by rand() limit 0,6");						  
 $numrows=mysqli_num_rows($cquery);
	   if($numrows>0)
	   {  
	   
	   while($resultset=mysqli_fetch_array($cquery))
	   {
		   							$listid=$resultset['ListingId'];

		   							$imageurl=getlocationwiseImage($conn,$listid);

		    $city=$resultset['city'];
		  
		   		   $price=$resultset['ListPrice']; 
							$address=$resultset['StreetName']." ".$city.$resultset['CountyOrParish'];

	   ?>                         
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                        <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">        <div class="geodir-category-img">
                                                <img src="<?php echo $imageurl;?>" alt="">
                                                <div class="overlay"></div>
                                                
                                            </div></a>
                                            <div class="geodir-category-content fl-wrap">
                                                                                               
                                                <h3>$<?php echo $price;?></h3>
  <p><?php echo limitContent($conn,$resultset['PublicRemarks'],50);?></p>                                               
   <div class="geodir-category-options fl-wrap">
    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address;?></a></div>
                                                </div>
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
                    <section>
                        <div class="container">
                            <div class="section-title">
                                <h2>How it works</h2>
                                <div class="section-subtitle">Discover & Connect </div>
                                <span class="section-separator"></span>
                                <p>Explore some of the best tips from around the world.</p>
                            </div>
                            <!--process-wrap  -->
                            <div class="process-wrap fl-wrap">
                                <ul>
                                    <li>
                                        <div class="process-item">
                                            <span class="process-count">01 . </span>
                                            <div class="time-line-icon"><i class="fa fa-map-o"></i></div>
                                            <h4> Find Interesting Place</h4>
                                            
                                        </div>
                                        <span class="pr-dec"></span>
                                    </li>
                                    <li>
                                        <div class="process-item">
                                            <span class="process-count">02 .</span>
                                            <div class="time-line-icon"><i class="fa fa-envelope-open-o"></i></div>
                                            <h4> Contact a Few Owners</h4>
                                           
                                        </div>
                                        <span class="pr-dec"></span>
                                    </li>
                                    <li>
                                        <div class="process-item">
                                            <span class="process-count">03 .</span>
                                            <div class="time-line-icon"><i class="fa fa-hand-peace-o"></i></div>
                                            <h4>Shift / Buy</h4>
                                            
                                        </div>
                                    </li>
                                </ul>
                              <!--  <div class="process-end"><i class="fa fa-check"></i></div>-->
                            </div>
                            <!--process-wrap   end-->
                        </div>
                    </section>
                    
                    <!-- section end -->
               
                 
                    <!--section -->
                    <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Testimonials</h2>
                                <div class="section-subtitle">Clients Reviews</div>
                                <span class="section-separator"></span>
                                
                            </div>
                        </div>
                        <!-- testimonials-carousel -->
                        <div class="carousel fl-wrap">
                            <!--testimonials-carousel-->
                            <div class="testimonials-carousel single-carousel fl-wrap">
                                <!--slick-slide-item-->
                                <?php 
								$selquery=mysqli_query($conn,"select * from `testimonial` where status='1'");
								$numrows=mysqli_num_rows($selquery);
								if($numrows>0)
								{
									while($resultset=mysqli_fetch_array($selquery))
									{
								
								?>
                                <div class="slick-slide-item">
                                    <div class="testimonilas-text">
                                       
                                        <p><?php echo $resultset['content'];?> </p>
                                    </div>
                                    <div class="testimonilas-avatar-item">
                                     
                                        <h4><?php echo ucfirst($resultset['name']);?></h4>
                                  
                                    </div>
                                </div>
                                
                                <?php } }?>
                                <!--slick-slide-item end-->
                            </div>
                            <!--testimonials-carousel end-->
                            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                        </div>
                        <!-- carousel end-->
                    </section>
                    <!-- section end -->
                  
            
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


$('#hidsearchtype').val(ui.item.type);     
//eventtype_idval=document.getElementById('eventtype_id').value;

//if(eventtype_idval=='2')
//{
//}





}
});


</script>