<?php
ob_start();
session_start();

include_once("configuration/connect.php");
include_once("configuration/functions.php");


if(isset($_GET['type']))
{
	
	$type=$_GET['type'];//1- city,2-zip,3-street address
	
		 $ptype=$_GET['ptype'];//rent or buy
	 $searchterm=$_GET['searchtype'];

	$pricetype=$_GET['pricetype'];
	if($type=='1')
	{
		$table="city like '%$searchterm%'";
		
		$query_ext="$table";
		
		
		
	}
	if($type=='2')
	{
		$table="ZIP_CODE_4 like '%$searchterm%'";
		
		$query_ext="$table";
		
		
		
	}
	
	if($type=='3')
	{
		$table="StreetName like '%$searchterm%'";
		
		$query_ext="$table";
		
		
		
	}
	
	if($pricetype!="")
	{
		if($pricetype=="low-to-high")
		{
		$tableq="order by `ListPrice` asc";
		
		}
		else
		{
				$tableq="order by `ListPrice` desc";
	
			
		}
		
	}
	else
	{
		
	$tableq="order by `ListPrice` asc";	
		
	}
}



//$actual_urlforlogin="$baseurl/property/$ptype/$searchterm/$type/$pricetype";
$actual_url="$baseurl/property";

  $actual_urlforlogin=$domain.$_SERVER['REQUEST_URI']; 

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
      <?php include_once("headernew.php");?>
      
       <input type="hidden" id="actual_url" name="actual_url" value="<?php echo $actual_url;?>">
       

            <!--  header end -->
            <!-- wrapper -->
            <div id="wrapper">
                <div class="content">
                    <!-- Map -->
                    <div class="map-container column-map left-pos-map">
                        <div id="map-main1">
                        
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d448181.163741622!2d76.81306442366602!3d28.64727993557044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x37205b715389640!2sDelhi!5e0!3m2!1sen!2sin!4v1556955088348!5m2!1sen!2sin" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                        <!--<ul class="mapnavigation">
                            <li><a href="#" class="prevmap-nav">Prev</a></li>
                            <li><a href="#" class="nextmap-nav">Next</a></li>
                        </ul>-->
						<div class="scrollContorl mapnavbtn" title="Enable Scrolling"><span><i class="fa fa-lock"></i></span></div>  						
                    </div>
                    <!-- Map end -->
                    <!--col-list-wrap -->
                    <div class="col-list-wrap right-list">
                        <div class="listsearch-options fl-wrap" id="lisfw" >
                            <div class="">
                                <!--<div class="listsearch-header fl-wrap">
                                    <h3>Results For : <span>Food and Drink</span></h3>
                                    <div class="listing-view-layout">
                                        <ul>
                                            <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                                            <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                                        </ul>
                                    </div>
                                </div>-->
                                <!-- listsearch-input-wrap  -->
                                <div class="listsearch-input-wrap fl-wrap">
                                   <div class="listsearch-input-item">
                                        <select data-placeholder="Price"class="chosen-select" onChange="price_filter(this.value,'<?php echo $actual_url;?>')" id="priceval">
                                        
                                        
                                   <?php 
							$selquery=mysqli_query($conn,"select * from `pricetype` where `status`='1'");
							while($results=mysqli_fetch_array($selquery))
							{
								$slug= $results['slug'];   
								   ?>
								     
                                            <option value="<?php echo $results['slug'];?>" <?php if($pricetype==$slug){?>selected<?php }?>><?php echo $results['name'];?></option>
<?php }?>                                           
                                        </select>
                                    </div>
                                   
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="Location" class="chosen-select" id="location" onChange="price_filter(this.value,'<?php echo $actual_url;?>')" >
                                          <?php 
										  
				$cquery=mysqli_query($conn,"select distinct `city` from `mlspindata_master` where `view`='1'");						  
						$numr=mysqli_num_rows($cquery);
						while($set=mysqli_fetch_array($cquery))
						{				  
									$searchtypess=strtolower(strreplace($conn,$set['city']));
	  
										  ?>
                                        <option value="<?php echo $searchtypess;?>" <?php if($searchterm==$searchtypess){?> selected <?php }?>> <?php echo $set['city'];?></option> 
                                          <?php }?>
                                        </select>
                                    </div>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="All Categories" class="chosen-select" id="category" onChange="price_filter(this.value,'<?php echo $actual_url;?>')">
                                           <?php 
												
												$query=mysqli_query($conn,"select * from `propertyfor` where `status`='1'");
												$numrowss=mysqli_num_rows($query);
												if($numrowss>0)
												{
											while($resultsets=mysqli_fetch_array($query))
											{	
											$p_slug=$resultsets['slug'];
												
												?>
                                                <option value="<?php echo $p_slug;?>" <?php if($p_slug==$ptype){?> selected<?php }?>><?php echo $resultsets['name'];?></option>
                                                <?php } }?>
                                        </select>
                                    </div>
                                    
                                    <!-- hidden-listing-filter -->
                                    <div class="hidden-listing-filter fl-wrap">
                                        <!--<div class="distance-input fl-wrap">
                                            <div class="distance-title"> Radius around selected destination <span></span> km</div>
                                            <div class="distance-radius-wrap fl-wrap">
                                                <input class="distance-radius rangeslider--horizontal" type="range" min="1" max="100" step="1" value="1" data-title="Radius around selected destination">
                                            </div>
                                        </div>-->
                                        <!-- Checkboxes -->
                                        <div class=" fl-wrap filter-tags">
                                            <h4>Filter </h4>
                                            <input id="check-a" type="checkbox" name="check">
                                            <label for="check-a">Newest</label>
                                            <input id="check-b" type="checkbox" name="check">
                                            <label for="check-b">Cheapest</label>
                                           
                                        </div>
                                    </div>
                                    <!-- hidden-listing-filter end -->
                                 <!--   <button class="button fs-map-btn" style="margin-top:5px">Apply</button>-->
                                    <div class="more-filter-option">More Filters <span></span></div>
                                </div>
                                <!-- listsearch-input-wrap end -->
                            </div>
                        </div>
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing">
                            <a class="custom-scroll-link back-to-filters btf-r" href="#lisfw"><i class="fa fa-angle-double-up"></i><span>Back to Filters</span></a>
                            <div class="">
                            
                            <?php 
							$searchquery=mysqli_query($conn,"select * from `mlspindata_master` where $query_ext $tableq limit 0,6");
							 $numrows=mysqli_num_rows($searchquery);
							while($resultset=mysqli_fetch_array($searchquery))
							{   
							$prop_id=$resultset['id'];
							$listid=$resultset['ListingId'];
							 $city=$resultset['city'];
							if($city!='')
							{
								
							$city=",".$resultset['city'];	
							}
							$address=$resultset['StreetName']." ".$city.$resultset['CountyOrParish'];
							
							$wishlist_val=getpropertwishlistvalue($conn,$userid,$prop_id);
							if($wishlist_val>0)
							{
								
							$fa_class="fa fa-heart";	
								
							}
							else
							{
								
														$fa_class="fa fa-heart-o";	
	
								
							}
							?>
                          
                                <!-- listing-item -->
                               
                                <div class="listing-item">
                                
                                       <article class="geodir-category-listing fl-wrap">
                                      <a href="<?php echo $baseurl;?>/property/<?php echo $listid;?>">    <div class="geodir-category-img">
                                               <img src="<?php echo $baseurl;?>/images/all/item_3.jpg" alt="">
                                                <div class="overlay"></div>
                                              
                                            </div></a>
                                            <div class="list-post-counter" onClick="wishlist('<?php echo $prop_id;?>')"><span id="propertymark<?php echo $prop_id;?>"><i class="<?php echo $fa_class;?>"></i></span></div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3>$<?php echo $resultset['ListPrice'];?></h3>
                                                <p>Morbiaccumsan ipsum velit tincidunt . </p>
                                                <div class="geodir-category-options fl-wrap">
                                                    
                                                    <div class="geodir-category-location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address;?></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    
                                    <?php }?>
                                <!-- listing-item end-->
                                
                                <!-- listing-item -->
                                
                                <!-- listing-item end-->
                              
                                
                                  <!-- listing-item -->
                                
                                     
                                <!-- listing-item end-->
                                
                               
                           
                            </div>
                            <a class="load-more-button" href="#">Load more <i class="fa fa-circle-o-notch"></i> </a>
                        </div>
                        <!-- list-main-wrap end-->
                    </div>
                    <!--col-list-wrap end -->
                    <div class="limit-box fl-wrap"></div>
                    <!--section -->
             <!--       <section class="gradient-bg">
                        <div class="cirle-bg">
                            <div class="bg" data-bg="<?php echo $baseurl;?>/images/bg/circle.png"></div>
                        </div>
                        <div class="container">
                            <div class="join-wrap fl-wrap">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>Join our online community</h3>
                                        <p>Grow your marketing and be happy with your online business</p>
                                    </div>
                                    <div class="col-md-4"><a href="#" class="join-wrap-btn modal-open">Sign Up <i class="fa fa-sign-in"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </section>-->
                    <!--section end -->
                </div>
                <!--content end -->
            </div>
            <!-- wrapper end --> 
         <!--footer -->
          <!--   <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>-->
          <?php include_once("footer.php");?> 
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&amp;libraries=places&amp;callback=initAutocomplete"></script>
        <script>


$( "#mainsearchbar" ).autocomplete({
   source: function (request, response) {
    $.ajax({
    url: baseurl+"/mainsearch.php",
      type: "GET",
      data: request,
        dataType: 'json',
       success: function (data) {
       response($.map(data, function (el) {
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




document.getElementById('workshopsubmit').focus()

}
});
</script>

<script type="text/javascript">
  
   
   var locations = [
	<?php echo $locations ?>
      
   ];


  var locations = [
   ['Kanpur', 26.4499, 80.3319,1],
	      ['Delhi', 28.5335197,77.21088570000006,2],

	   ];
//      ['Coogee Beach', -33.923036, 151.259052, 5],
//      ['Cronulla Beach', -34.028249, 151.157507, 3],
//      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
//      ['Maroubra Beach', -33.950198, 151.259302, 1]
//    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng('26.4499','80.3319'),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });
google.maps.event.addListener(marker,'click',function() {
	alert();
  map.setZoom(9);
  document.getElementById('yes').style.display='block';
  map.setCenter(marker.getPosition());
});
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
    </body>
</html>