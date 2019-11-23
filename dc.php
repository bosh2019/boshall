<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");
$listid=2;

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
        <!--=============== css  ===============-->
        <link type="text/css" rel="stylesheet" href="css/reset.css">
        <link type="text/css" rel="stylesheet" href="css/plugins.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/color.css">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.png">
   <style>
	.box-widget-wrap.sidebar {
    position: fixed;
    top: 22%;
    width: 29%;
		
	}
	   .box-widget-wrap
	   {
		   margin-bottom: 30px;
	   }
	   .owl-nav button {
      position: absolute;
    top: 32%;
    transform: translateY(-50%);
    /* background: rgba(255, 255, 255, 0.38) !important; */
}
	   .owl-nav .owl-prev span {
    font-size: 8em;
    color: #939393;
    font-weight: 100;
    position: relative;
    left: -30px;
}
	     .owl-nav .owl-next span {
    font-size: 8em;
    color: #939393;
    font-weight: 100;
    position: relative;
    left: 30px;
}
.owl-nav button.owl-prev {
  left: 0;
}
.owl-nav button.owl-next {
  right: 0;
}

.owl-dots {
  text-align: center;
  padding-top: 15px;
	display: none;
}
.owl-dots button.owl-dot {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  display: inline-block;
  background: #ccc;
  margin: 0 3px;
}
.owl-dots button.owl-dot.active {
  background-color: #000;
}
.owl-dots button.owl-dot:focus {
  outline: none;
}
.tour {
    font-size: 24px;
    margin-bottom: 20px;
}
.color-bg {
    width: 100%;
    border: 1px solid #4db7fe;
    border-radius: 2px;
    font-size: 18px;
    font-weight: 400;
	margin-top: 20px;
	margin-bottom: 10px;
	cursor: pointer;
}
	   .free {
    color: #919191;
    font-weight: 500;
}
 </style>
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="pin"></div>
            <div class="pulse"></div>
        </div>
        <!--loader end-->
        <!-- Main  -->
        <div id="main">
            <!-- header-->
            <header class="main-header dark-header fs-header sticky">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a href="index.html"><img src="images/logo.png" alt=""></a>
                    </div>
                    
                   
                    <div class="show-reg-form modal-open"><i class="fa fa-sign-in"></i>Sign In</div>
                    <!-- nav-button-wrap-->
                    <div class="nav-button-wrap color-bg">
                        <div class="nav-button">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <!-- nav-button-wrap end-->
                    <!--  navigation -->
                    <div class="nav-holder main-menu">
                        <nav>
                            <ul>
                                <li> <a href="#" class="act-link">Home </a>  </li>
                                <li> <a href="#">Buy</a></li>
                                <li> <a href="#">Rent</a></li>
                               <!-- <li> <a href="#">Sell</a></li>-->
                              
                            </ul>
                        </nav>
                    </div>
                    <!-- navigation  end -->
                </div>
            </header>
            <!--  header end -->
            
            
            <!-- wrapper -->
            <div id="wrapper">
                <!-- content-->
                <div class="content">
                  
                    <div class="scroll-nav-wrapper fl-wrap">
                        <div class="container">
                            <nav class="scroll-nav scroll-init">
                                <ul>
                                    <li><a class="act-scrlink" href="#sec1">About</a></li>
                                    <li><a href="#sec2">Details</a></li>
                                    <li><a href="#sec3">Amenities</a></li>
                                     <li><a href="#sec4">History</a></li>
                                    <li><a href="#sec5">Location</a></li>
                                    
                                </ul>
                            </nav>
                          
                        </div>
                    </div>
                    <!-- section-->
                    <section class="gray-section no-top-padding" style="background: #ffffff">
                        <div class="container other-c">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="list-single-main-wrapper fl-wrap" id="sec1">
                                          <div class="list-single-main-media fl-wrap">
                                            <div class="single-slider-wrapper fl-wrap">
                                                <div class="single-slider fl-wrap"  >
                                                    <div class="slick-slide-item"><img src="images/all/1.jpg" alt=""></div>
                                                    <div class="slick-slide-item"><img src="images/all/22.jpg" alt=""></div>
                                                    <div class="slick-slide-item"><img src="images/all/5.jpg" alt=""></div>
                                                </div>
                                                <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                                                <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="list-single-main-item fl-wrap">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>About</h3>
                                            </div>
                                            <p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</p>
                                       
                                            
                                           
                                        </div>
                                        
                                        
                                        <div class="list-single-main-item fl-wrap" id="sec2">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Details </h3>
                                            </div>
                                            <div class="team-holder fl-wrap">
                                              <div class="listing-features fl-wrap">
                                           <ul class="row">
   <li class="col-sm-6"> Subdivision
<span class="left">Cardinal Glen</span></li>
<li class="col-sm-6">Style
<span class="left">Contemporary</span>
</li>
<li class="col-sm-6">roperty Type
<span class="left">Single-Family</span></li>
<li class="col-sm-6">Community
<span class="left">Cardinal Glen</span></li>
<li class="col-sm-6">County
<span class="left">Dane</span></li>
<li class="col-sm-6">MLS#
<span class="left">1856352</span></li>
<li class="col-sm-6">Built
<span class="left">2009</span></li>
<li class="col-sm-6">Lot Size
<span class="left">3,484 square feet</span></li>
</ul>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <!-- list-single-main-item -->
                                        <div class="list-single-main-item fl-wrap" id="sec3" style="border: 1px solid gainsboro;border-radius: 0px !important;">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Amenities </h3>
                                            </div>
                                            <div class="team-holder fl-wrap">
                                              <div class="listing-features fl-wrap">
                                                <ul>
                                                    <li><i class="fa fa-rocket"></i> Elevator in building</li>
                                                    <li><i class="fa fa-wifi"></i> Free Wi Fi</li>
                                                    <li><i class="fa fa-motorcycle"></i> Free Parking</li>
                                                    <li><i class="fa fa-cloud"></i> Air Conditioned</li>
                                                    <li><i class="fa fa-shopping-cart"></i> Online Ordering</li>
                                                    <li><i class="fa fa-paw"></i> Pet Friendly</li>
                                                    <li><i class="fa fa-tree"></i> Outdoor Seating</li>
                                                    <li><i class="fa fa-wheelchair"></i> Wheelchair Friendly</li>
                                                </ul>
                                            </div>
                                            </div>
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Interior Features </h3>
                                            </div>
                                             <div class="flex-list">
                                             <h2 class="heading">Master Bedroom Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions: 16X17</li>
                                             		<li>On Third Floor</li>
                                             	</ul>
                                             <h2 class="heading">Bedroom #2 Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions:  15X15</li>
                                             		<li>On Second Floor</li>
                                             	</ul>
                                            <h2 class="heading">Bedroom #3 Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions:  11X16</li>
                                             		<li>On Second Floor</li>
                                             	</ul>
                                             	<h2 class="heading">Bedroom  Information</h2>
                                             	<ul class="detail">
                                             		<li># of Bathrooms (Full): 2</li>
                                             		<li># of Bathrooms (1/2): 1</li>
                                             		<li>Has Master Bathroom</li>
                                             	</ul>
                                             </div>
                                             <div class="flex-list1">
                                             <h2 class="heading">Bathroom #3 Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions: 5X8</li>
                                             		<li>On Third Floor</li>
                                             	</ul>
                                             <h2 class="heading">Living Room Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions: 12X17</li>
                                             		<li>On First Floor</li>
                                             	</ul>
                                            <h2 class="heading">Dining Room Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions: 12X15</li>
                                             		<li>On First Floor</li>
                                             	</ul>
                                             <h2 class="heading">Kitchen Information</h2>
                                             	<ul class="detail">
                                             		<li>Dimensions: 12X15</li>
                                             		<li>On First Floor</li>
                                             	</ul>	
                                             </div>
                                        </div>
                                        <!-- list-single-main-item end -->
                                  <div class="list-single-main-item fl-wrap" id="sec4" style="    border-bottom: none;">
                                      <div class="list-single-main-item-title fl-wrap">
                                           <h3>History </h3>
                                        </div>
                                    <table class="table">
                                     <thead>
                                     	<tr>
                                     	  <th>Date</th>
                                     	  <th>Event & Source</th>
                                     	  <th>Price</th>
                                     	  <th>Appreciation</th>
                                     	</tr>
                                     </thead>
                                     <tbody>
                                     	<tr>
                                     		<td>May 6, 2019</td>
                                     		<td>Listed (New)<div class="d-p">MLS PIN #72491446</div></td>
                                     		<td>$699,000</td>
                                     		<td>__</td>
                                     	</tr>
                                     	<tr>
                                     		<td>May 10, 2019</td>
                                     		<td>Sold (MLS) (Sold)<div class="d-p">MLS PIN #71990782</div></td>
                                     		<td>$645,000</td>
                                     		<td>__</td>
                                     	</tr>
                                     	<tr>
                                     		<td>May 12, 2019</td>
                                     		<td>Pending (Under Agreement)<div class="d-p">MLS PIN #71990782	</div></td>
                                     		<td>__</td>
                                     		<td>__</td>
                                     	</tr>
                                     	<tr>
                                     		<td>April 12, 2019</td>
                                     		<td>Contingent (Under Agreement)<div class="d-p">MLS PIN #71652191	</div></td>
                                     		<td>__</td>
                                     		<td>__</td>
                                     	</tr>
                                     </tbody>
                                    </table>      
                                 </div>      
                                        
                                        <div class="list-single-main-item fl-wrap" id="sec5">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Location </h3>
                                            </div>
                                            <div class="team-holder fl-wrap">
                                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d188820.04330564957!2d-71.11036981339626!3d42.31451859198264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3652d0d3d311b%3A0x787cbf240162e8a0!2sBoston%2C+MA%2C+USA!5e0!3m2!1sen!2sin!4v1557129179641!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                 
                                     
                                    </div>
                                </div>
                                <!--box-widget-wrap -->
                                <form method="post" action="<?php echo $baseurl;?>/book/<?php echo $listid;?>">
                                <input type="hidden" id="hiddendate" name="hiddendate" value="">
                                <div class="col-md-4">
                                <div class="box-widget-wrap">
                                <h3 class="tour">Go Tour This Home</h3>
                                <div id="carousel" class="owl-carousel">
                                
                              <?php   
                                $alldates=getalldatesofmonth($pdate,$pyear);
								
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
								?>
                                
                                
	<div class="item" >
		<div class="ldpGrayDayOptionContainer" onClick="setDates('<?php echo $dates;?>')"><div class="dayOfTheWeek"><?php echo date('D', strtotime($dates));?></div><div class="dayOfTheMonth"><?php echo $mydate;?></div><div class="month"><?php echo $monthnew;?></div></div>
	</div>
    
    <?php  } }?>
	
</div>
						<button type="submit" class="btn  big-btn  color-bg flat-btn book-btn">Schedule Tour<i class="fa fa-angle-right"></i></button>
								<span class="free">It's free, with no obligation — cancel anytime</span>
								<div class="contactlink">
									<ul class="ask">
										<li><a href="#">Ask Question</a></li>
									</ul>
									<ul class="number">
										<li><a href="tel:+10000000" class="phone-number TextOrCallPhoneLink">(603) 00000000</a></li>
									</ul>
								</div>
									</div>
                                   <!--
                                    <div class="box-widget-wrap"> 
                                     <div class="box-widget-item fl-wrap">
                                           
                                            <div class="box-widget opening-hours">
                                                <div class="box-widget-content">
                                                    <form   class="add-comment custom-form">
                                                        <fieldset>
                                                            <label><i class="fa fa-user-o"></i></label>
                                                            <input type="text" placeholder="Your Name *" value=""/>
                                                            <div class="clearfix"></div>
                                                            <label><i class="fa fa-envelope-o"></i>  </label>
                                                            <input type="text" placeholder="Email Address*" value=""/>
                                                            <label><i class="fa fa-phone"></i>  </label>
                                                            <input type="text" placeholder="Phone*" value=""/>
                                                         <label><i class="fa fa-calendar-check-o"></i>  </label>
                                                                    <input type="text" placeholder="Date" class="datepicker"   data-large-mode="true" data-large-default="true"   value=""/>
													        <label><i class="fa fa-clock-o"></i>  </label>
                                                                    <input type="text" placeholder="Time" class="timepicker" value="12:00 am"/>
                                                            </fieldset>
                                                        <button class="btn  big-btn  color-bg flat-btn">Schedule Visit<i class="fa fa-angle-right"></i></button>
                                                    </form>
                                                    
                                                    <div class="list-author-widget-contacts list-item-widget-contacts" style="margin-top:50px">
                                                        <ul>
                                                            <li><span><i class="fa fa-phone"></i> Ask a Question :</span> <a href="#">+7(123)987654</a></li>
                                                          </ul>
                                                    </div>
                                                </div> 
                                                
                                                 
                                            </div>
                                        </div>
                                     </div>
-->
                                </div>
                                
                                </form>
                                <!--box-widget-wrap end -->
                            </div>
                        </div>
                    </section>
                    <!-- section end-->
                      <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Nearby Similar Homes</h2>
                                <div class="section-subtitle">Best Selling</div>
                                <span class="section-separator"></span>
                                <p>Nulla tristique mi a massa convallis cursus. Nulla eu mi magna.</p>
                            </div>
                        </div>
                        <!-- carousel -->
                        <div class="list-carousel fl-wrap card-listing ">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">
                                <!--slick-slide-item-->
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/item_1.jpg" alt="">
                                                <div class="overlay"></div>
                                                
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                                                               
                                                <h3>$609,900</h3>
                                                <p>Sed interdum metus at nisi tempor laoreet.  </p>
                                                <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end-->
                                </div>
                                <!--slick-slide-item end-->
                                <!--slick-slide-item-->
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/item_2.jpg" alt="">
                                                <div class="overlay"></div>
                                                
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                                                             
                                                <h3>$339,900</h3>
                                                <p>Morbi suscipit erat in diam bibendum rutrum.</p>
                                                <div class="geodir-category-options fl-wrap">
                                                  <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end-->
                                </div>
                                <!--slick-slide-item end-->
                                <!--slick-slide-item-->
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/item_3.jpg" alt="">
                                                <div class="overlay"></div>
                                             
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$229,900</h3>
                                                <p>Morbiaccumsan ipsum velit tincidunt . </p>
                                                <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end-->
                                </div>
                                <!--slick-slide-item end-->
                                <!--slick-slide-item-->
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/item_4.jpg" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                                                            
                                                <h3>$679,900</h3>
                                                <p>Morbiaccumsan ipsum velit tincidunt . </p>
                                                <div class="geodir-category-options fl-wrap">
                                                   
                                                    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end-->
                                </div>
                                <!--slick-slide-item end-->
                                <!--slick-slide-item-->
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/item_5.jpg" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                              
                                                <h3>$589,900</h3>
                                                <p>Lorem ipsum gravida nibh vel velit.</p>
                                                <div class="geodir-category-options fl-wrap">
                                                  
                                                    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end-->
                                </div>
                                <!--slick-slide-item end-->
                                <!--slick-slide-item-->
                                <div class="slick-slide-item">
                                    <!-- listing-item -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <img src="images/all/item_6.jpg" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                              
                                                <h3>$579,900</h3>
                                                <p>Sed non neque elit. Sed ut imperdie.</p>
                                                <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end-->
                                </div>
                                <!--slick-slide-item end-->
                            </div>
                            <!--listing-carousel end-->
                            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                        </div>
                        <!--  carousel end-->
                    </section>
                    <div class="limit-box fl-wrap"></div>
                    <div class="limit-box fl-wrap"></div>
                    <!-- section -->
                   
                    <!-- section end-->
                </div>
                <!-- content end-->
            </div>
            <!-- wrapper end -->
         <!--footer -->
            <footer class="main-footer ">
                  <div class="sub-footer fl-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="about-widget">
                                    <img src="images/logo.png" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="copyright"> &#169; Boshall 2019 .  All rights reserved.</div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-social">
                                    <ul>
                                        <li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fa fa-chrome"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fa fa-vk"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fa fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--footer end  -->
            <!--register form -->
            <div class="main-register-wrap modal">
                <div class="main-overlay"></div>
                <div class="main-register-holder">
                    <div class="main-register fl-wrap">
                        <div class="close-reg"><i class="fa fa-times"></i></div>
                        <h3>Sign In <span>Bos<strong>Hall</strong></span></h3>
                        <!--<div class="soc-log fl-wrap">
                            <p>For faster login or register use your social account.</p>
                            <a href="#" class="facebook-log"><i class="fa fa-facebook-official"></i>Log in with Facebook</a>
                            <a href="#" class="twitter-log"><i class="fa fa-twitter"></i> Log in with Twitter</a>
                        </div>-->
                     <!--   <div class="log-separator fl-wrap"><span>or</span></div>-->
                        <div id="tabs-container">
                            <ul class="tabs-menu">
                                <li class="current"><a href="#tab-1">Login</a></li>
                                <li><a href="#tab-2">Register</a></li>
                            </ul>
                            <div class="tab">
                                <div id="tab-1" class="tab-content">
                                    <div class="custom-form">
                                        <form method="post"  name="registerform">
                                            <label>Username or Email Address * </label>
                                            <input name="email" type="text"   onClick="this.select()" value="">
                                            <label >Password * </label>
                                            <input name="password" type="password"   onClick="this.select()" value="" >
                                            <button type="submit"  class="log-submit-btn"><span>Log In</span></button>
                                            <div class="clearfix"></div>
                                            <div class="filter-tags">
                                                <input id="check-a" type="checkbox" name="check">
                                                <label for="check-a">Remember me</label>
                                            </div>
                                        </form>
                                        <div class="lost_password">
                                            <a href="#">Lost Your Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div id="tab-2" class="tab-content">
                                        <div class="custom-form">
                                            <form method="post"   name="registerform" class="main-register-form" id="main-register-form2">
                                                <label >First Name * </label>
                                                <input name="name" type="text"   onClick="this.select()" value="">
                                                <label>Second Name *</label>
                                                <input name="name2" type="text"  onClick="this.select()" value="">
                                                <label>Email Address *</label>
                                                <input name="email" type="text"  onClick="this.select()" value="">
                                                <label >Password *</label>
                                                <input name="password" type="password"   onClick="this.select()" value="" >
                                                <button type="submit"     class="log-submit-btn"  ><span>Register</span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!--register form end -->
            <a class="to-top"><i class="fa fa-angle-up"></i></a> 
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->     
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&amp;libraries=places&amp;callback=initAutocomplete"></script>
        <script>

$(function() {
   $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
      $(".box-widget-wrap").addClass("sidebar");
    } else {
     $(".box-widget-wrap").removeClass("sidebar");
    }
  });
});

			$("#carousel").owlCarousel({
  autoplay: false,
  lazyLoad: true,
  loop: true,
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },

    1366: {
      items: 3
    }
  }
});

function setDates(val)
{
$("#hiddendate").val(val);
	
}
</script>
    </body>
</html>